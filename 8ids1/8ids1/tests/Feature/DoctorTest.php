<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Especialidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DoctorTest extends BaseTestCase
{
    use WithFaker;

    protected $user;
    protected $especialidad;

    protected function setUp(): void
    {
        parent::setUp();

        // Iniciar una transacción
        DB::beginTransaction();

        // Limpiar tablas específicas
        DB::table('doctores')->truncate();
        DB::table('users')->truncate();
        DB::table('especialidades')->truncate();

        // Crear datos necesarios
        $this->user = User::factory()->create();
        $this->especialidad = Especialidad::factory()->create();
    }

    protected function tearDown(): void
    {
        // Revertir la transacción
        DB::rollBack();

        parent::tearDown();
    }

    public function test_user_can_see_create_doctor_form()
    {
        $response = $this->actingAs($this->user)->get('/doctor');

        $response->assertStatus(200);
        $response->assertSee('Formulario de Doctor');
        $response->assertViewHas('especialidades', Especialidad::all());
    }

    public function test_user_can_list_all_doctors()
    {
        $doctor = Doctor::factory()->create([
            'idusr' => $this->user->id,
            'id_especialidad' => $this->especialidad->id,
        ]);

        $response = $this->actingAs($this->user)->get('/doctores');

        $response->assertStatus(200);
        $response->assertSee($doctor->nombre);
    }

    public function test_user_can_save_or_update_doctor()
    {
        $doctorData = [
            'nombre' => $this->faker->unique()->name,
            'apellido_paterno' => $this->faker->lastName,
            'apellido_materno' => $this->faker->lastName,
            'id_especialidad' => $this->especialidad->id,
            'cedula' => $this->faker->unique()->numberBetween(100000, 999999),
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password', // Asegúrate de que el password esté correctamente hasheado
            'id' => 0 // Asumiendo que '0' es para una nueva creación
        ];

        $response = $this->actingAs($this->user)->post('/doctor/save', $doctorData);

        $response->assertStatus(302);
        $response->assertRedirect(route('doctores'));
        $this->assertDatabaseHas('doctores', ['email' => $doctorData['email']]);
    }

    public function test_user_can_delete_doctor()
    {
        // Crear un doctor para la prueba
        $doctor = Doctor::factory()->create([
            'idusr' => $this->user->id,
            'id_especialidad' => $this->especialidad->id,
        ]);
    
        // Verifica que el doctor exista antes de eliminar
        $this->assertDatabaseHas('doctores', ['id' => $doctor->id]);
    
        // Ejecuta la solicitud de eliminación
        $response = $this->actingAs($this->user)->delete('/doctor/delete/' . $doctor->id);
    
        // Verifica el estado de la respuesta
        $response->assertStatus(302);
        $response->assertRedirect(route('doctores'));
    
        // Verifica que el doctor haya sido eliminado de la base de datos
        $this->assertDatabaseMissing('doctores', ['id' => $doctor->id]);
    }
}    
