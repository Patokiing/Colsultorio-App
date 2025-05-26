<?php

namespace Tests\Feature;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class PacienteTest extends TestCase
{

    /** @test */
    public function user_can_create_a_paciente()
    {
        $response = $this->post('/pacientes', [
            'nombre' => 'Estrella',
            'ApPat' => 'Lowe',
            'ApMat' => 'Hansen',
            'tele' => '1234567890',
            'email' => 'estrella@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(302); // Redirect to some page after creation

        $this->assertDatabaseHas('pacientes', [
            'nombre' => 'Estrella',
            'ApPat' => 'Lowe',
            'ApMat' => 'Hansen',
        ]);
    }

 


public function testCanDeletePacienteViaAPI()
{
    $user = User::factory()->create();
    $paciente = Paciente::factory()->create(['idusr' => $user->id]);

    $response = $this->deleteJson('/api/pacientes/' . $paciente->id);

    $response->assertStatus(200)
             ->assertJson(['message' => 'Paciente eliminado correctamente']);
}
}