<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\User;

class CitasTest extends TestCase
{
   

    /** @test */
    public function testCanListCitas()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    
        $response = $this->get('/citas');
    
        $response->assertStatus(200);
        $response->assertSee('Lista de Citas');
    }
    
    public function testCanShowCitaForAuthorization()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    
        $cita = Cita::factory()->create();
    
        $response = $this->get('/citas/' . $cita->id . '/authorize');
    
        $response->assertStatus(200);
        $response->assertSee('Autorizar Cita');
    }
    
       
       
       /** @test */
     
   }
