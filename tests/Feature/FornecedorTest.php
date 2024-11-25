<?php

namespace Tests\Feature;

use App\Helpers\Formatter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class FornecedorTest extends TestCase
{
    use RefreshDatabase;
    public $documentoReal = '03.995.142/0001-24';
    public $documentoFake = '32.122.122/0001-11';
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_salvar_fornecedor_sucesso()
    {
        $response = $this->postJson('/api/salvarFornecedor', $this->montarJsonDocumento(true));
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson([
            'message' => 'Fornecedor salvo com sucesso!'
        ]);
    }

    public function test_atualizar_fornecedor_sucesso()
    {
        $jsonAtualizar = [
            "documento" => $this->documentoReal,
	        "razao_social" => 'Teste realizado',
            "telefone" => '4100000000',
            "cep" => '00000000',
            "natureza_juridica" => 'Teste de natureza juridica',
            "situacao_cadastral" => 'INAPTA'
        ];

        $this->postJson('/api/salvarFornecedor', $this->montarJsonDocumento(true));
        $response = $this->putJson('/api/atualizarFornecedor', $jsonAtualizar);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'message' => 'Fornecedor atualizado com sucesso!'
        ]);
    }

    public function test_excluir_fornecedor_sucesso()
    {
        $this->postJson('/api/salvarFornecedor', $this->montarJsonDocumento(true));
        $response = $this->deleteJson('/api/deletarFornecedor', $this->montarJsonDocumento(true));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'message' => 'Fornecedor deletado com sucesso!'
        ]);
    }

    public function test_listar_fornecedores()
    {
        $response = $this->get('/api/listarFornecedores');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure($this->montarJsonStructure());
    }

    public function test_salvar_fornecedor_erro()
    {
        $response = $this->postJson('/api/salvarFornecedor', $this->montarJsonDocumento(false));
        $mensagemErro = 'Não foi encontrado as informações desse CNPJ.';
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson([
            'error' => [
                'message' => $mensagemErro,
                'status_code' => Response::HTTP_NOT_FOUND
            ]
        ]);
    }

    public function test_atualizar_fornecedor_erro()
    {
        $jsonAtualizar = [
            "documento" => $this->documentoFake,
            "razao_social" => 'Teste realizado',
            "telefone" => '4100000000',
            "cep" => '00000000',
            "natureza_juridica" => 'Teste de natureza juridica',
            "situacao_cadastral" => 'INAPTA'
        ];

        $this->postJson('/api/salvarFornecedor', $this->montarJsonDocumento(true));
        $response = $this->putJson('/api/atualizarFornecedor', $jsonAtualizar);

        $mensagemErro = 'Não foi possivel encontrado o fornecedor com o documento ' . Formatter::formatCnpj($this->documentoFake) . ' na nossa base dados.';
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson([
            'error' => [
                'message' => $mensagemErro,
                'status_code' => Response::HTTP_NOT_FOUND
            ]
        ]);
    }

    public function test_excluir_fornecedor_erro()
    {
        $this->postJson('/api/salvarFornecedor', $this->montarJsonDocumento(true));

        $response = $this->deleteJson('/api/deletarFornecedor', $this->montarJsonDocumento(false));
        $mensagemErro = "Não foi possivel encontrado o fornecedor com o documento " . Formatter::formatCnpj($this->documentoFake) . " na nossa base dados.";

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson([
            'error' => [
                'message' => $mensagemErro,
                'status_code' => Response::HTTP_NOT_FOUND
            ]
        ]);
    }

    private function montarJsonDocumento($isReal)
    {
        return [
            "documento" => $isReal ? $this->documentoReal : $this->documentoFake
        ];
    }

    private function montarJsonStructure(){
        return [
            'message' => [
                'current_page',
                'data' => [
                    '*' => $this->montarDataFornecedor(),
                ],
                'current_page',
                'per_page',
                'total',
                'last_page',
            ]
        ];
    }

    private function montarDataFornecedor()
    {
        return [
            'id',
            'documento',
            'razao_social',
            'telefone',
            'cep',
            'natureza_juridica',
            'situacao_cadastral',
            'created_at',
            'updated_at',
            'deleted_at'
        ];
    }
}
