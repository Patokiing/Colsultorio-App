<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Especialidad;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EspecialidadTest extends TestCase
{
    use WithFaker;
    use WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        // Puedes hacer alguna configuración adicional aquí si es necesario
    }

    protected function tearDown(): void
    {
        // Limpia la base de datos entre pruebas
        Especialidad::truncate();
        User::truncate();
        
        parent::tearDown();
    }

    /**
     * Test that a user can see the create especialidad form.
     *
     * @return void
     */
    public function test_user_can_see_the_create_specialidad_form()
    {
        // Crea un usuario y autentícalo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Realiza la solicitud
        $response = $this->get(route('nueva.especialidad'));

        // Asegúrate de que la respuesta es correcta
        $response->assertStatus(200);
        $response->assertViewIs('especialidad');
        $response->assertSee('Nueva Especialidad');
    }

    /**
     * Test that a user can create a new especialidad.
     *
     * @return void
     */
    public function test_user_can_create_a_new_specialidad()
    {
        // Crea un usuario y autentícalo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Datos de la nueva especialidad
        $data = ['nombre' => 'Cardiología'];

        // Realiza la solicitud
        $response = $this->post(route('guardar.especialidad'), $data);

        // Asegúrate de que la redirección y el mensaje son correctos
        $response->assertRedirect(route('especialidades'));
        $response->assertSessionHas('success', 'Especialidad creada exitosamente.');

        // Verifica que la especialidad se ha guardado en la base de datos
        $this->assertDatabaseHas('especialidades', $data);
    }

    /**
     * Test that a user can edit an existing especialidad.
     *
     * @return void
     */
    public function test_user_can_edit_an_existing_specialidad()
    {
        // Crea un usuario y autentícalo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crea una especialidad existente
        $especialidad = Especialidad::create(['nombre' => 'Cardiología']);

        // Datos para actualizar la especialidad
        $data = ['nombre' => 'Neumología', 'id' => $especialidad->id];

        // Realiza la solicitud de actualización
        $response = $this->post(route('guardar.especialidad'), $data);

        // Asegúrate de que la redirección y el mensaje son correctos
        $response->assertRedirect(route('especialidades'));
        $response->assertSessionHas('success', 'Especialidad actualizada exitosamente.');

        // Verifica que la especialidad se ha actualizado en la base de datos
        $this->assertDatabaseHas('especialidades', ['nombre' => 'Neumología']);
    }

    /**
     * Test that a user can delete an existing especialidad.
     *
     * @return void
     */
    public function test_user_can_delete_an_existing_specialidad()
    {
        // Crea un usuario y autentícalo
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crea una especialidad existente
        $especialidad = Especialidad::create(['nombre' => 'Cardiología']);

        // Realiza la solicitud de eliminación
        $response = $this->post(route('eliminar.especialidad'), ['id' => $especialidad->id]);

        // Asegúrate de que la redirección y el mensaje son correctos
        $response->assertRedirect(route('especialidades'));
        $response->assertSessionHas('success', 'Especialidad eliminada exitosamente.');

        // Verifica que la especialidad ha sido eliminada de la base de datos
        $this->assertDatabaseMissing('especialidades', ['id' => $especialidad->id]);
    }
}
