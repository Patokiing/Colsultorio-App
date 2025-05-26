<?php

namespace Tests\Feature;

use App\Models\Medicamento;
use Tests\TestCase;

class MedicamentoTest extends TestCase
{
    public function test_it_can_list_medicamentos()
    {
        $medicamentos = Medicamento::factory()->count(3)->create();

        $response = $this->get('/medicamentos');

        $response->assertStatus(200);
        foreach ($medicamentos as $medicamento) {
            $response->assertSee($medicamento->descripcion);
        }
    }

    public function test_it_can_show_a_medicamento()
    {
        $medicamento = Medicamento::factory()->create();

        $response = $this->get('/medicamentos/' . $medicamento->id);

        $response->assertStatus(200);
        $response->assertSee($medicamento->descripcion);
    }

    public function test_it_can_save_a_new_medicamento()
    {
        $response = $this->post('/medicamentos', [
            'codigo' => '12345',
            'descripcion' => 'Medicamento de prueba',
            'precio' => 100,
            'fecha_caducidad' => '2025-12-31',
            'existencia' => 10
        ]);

        $response->assertRedirect('/medicamentos');
        $this->assertDatabaseHas('medicamentos', [
            'codigo' => '12345',
            'descripcion' => 'Medicamento de prueba',
            'precio' => 100,
            'fecha_caducidad' => '2025-12-31',
            'existencia' => 10
        ]);
    }

    public function test_it_can_update_an_existing_medicamento()
    {
        $medicamento = Medicamento::factory()->create();

        $response = $this->post('/medicamentos', [
            'id' => $medicamento->id,
            'codigo' => '67890',
            'descripcion' => 'Medicamento actualizado',
            'precio' => 150,
            'fecha_caducidad' => '2026-12-31',
            'existencia' => 20
        ]);

        $response->assertRedirect('/medicamentos');
        $this->assertDatabaseHas('medicamentos', [
            'codigo' => '67890',
            'descripcion' => 'Medicamento actualizado',
            'precio' => 150,
            'fecha_caducidad' => '2026-12-31',
            'existencia' => 20
        ]);
    }

    public function test_it_can_delete_a_medicamento()
    {
        $medicamento = Medicamento::factory()->create();

        $response = $this->delete('/medicamentos/' . $medicamento->id);

        $response->assertRedirect('/medicamentos');
        $this->assertDatabaseMissing('medicamentos', [
            'id' => $medicamento->id
        ]);
    }
}
