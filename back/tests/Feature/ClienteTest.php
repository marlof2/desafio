<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    /**
     * comente o DatabaseTransactions para que os dados do teste persistam no banco de dados
     */
    use DatabaseTransactions;

    /**
     * Método deve retornar status http 201 ao inserir um cliente
     * @group fluxo-adicionar
     * @return array
     * @author Marlo Marques
     */
    public function test_storeCliente()
    {
        $faker = Factory::create('pt_BR');

        $dataStore = [
            'nome' => 'Marlo',
            'cpf' => '03268501475',
            'email' => $faker->email,
            'telefone' => '(71) 991717209',
            'endereco' => 'Rua B',
        ];
        $response = $this->postJson('/api/cliente/store', $dataStore);
        $response->assertStatus(201);
    }

    /**
     * Método deve retornar status http 200 ao alterar um cliente
     * @group fluxo-alterar
     * @return array
     * @author Marlo Marques
     */
    public function test_UpdateCliente()
    {
        $faker = Factory::create('pt_BR');
        $cliente = Cliente::where('id', 1)->get();

        $dataUpdate = [
            'nome' => $cliente[0]['nome'] = $faker->name,
            'cpf' => $cliente[0]['cpf'] = $faker->cpf,
            'email' => $cliente[0]['email'] = $faker->email,
            'telefone' => $cliente[0]['telefone'] = $faker->phoneNumber,
            'endereco' => $cliente[0]['endereco'] = $cliente[0]['endereco'] . ' ' . +1,
        ];

        $response = $this->putJson('/api/cliente/update/1', $dataUpdate);
        $response->assertStatus(200);
    }

    /**
     * Método deve retornar status http 200 ao deletar um cliente
     * @group fluxo-deletar
     * @return array
     * @author Marlo Marques
     *
     */
    public function test_DeleteCliente()
    {

        $cliente = Cliente::find(1);
        $response = $this->deleteJson('/api/cliente/delete/' . $cliente['id']);
        $response->assertStatus(200);

    }
}
