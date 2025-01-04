<?php

namespace Tests\Feature;

use App\Models\UE;
use App\Models\EC;
use App\Models\Etudiant;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UETest extends TestCase
{
    use RefreshDatabase;

    // Test de création d'une UE valide
    public function test_creation_ue_valide()
{
    $response = $this->postJson('/api/ues', [
        'code' => 'UE11',
        'nom' => 'Programmation Web',
        'credits' => 6,
        'semestre' => 1,
    ]);

    $response->assertStatus(201);
    $response->assertJson([
        'code' => 'UE11',
        'nom' => 'Programmation Web',
        'credits' => 5,
        'semestre' => 1,
    ]);
}


    // Vérification des crédits ECTS (entre 1 et 30)
    public function test_validation_credits_ects()
{
    $response = $this->postJson('/api/ues', [
        'code' => 'UE12',
        'nom' => 'Base de données',
        'credits' => 15, // Supposons que le max soit 30, par exemple
        'semestre' => 1,
    ]);

    $response->assertStatus(422);  // Erreur de validation
    $response->assertJsonValidationErrors(['credits_ects']);
}

    // Test d'association des ECs à une UE
    public function test_association_ue_ec()
    {
        $ue = UE::factory()->create();
        $ec = EC::factory()->create(['ue_id' => $ue->id]);

        $this->assertEquals($ue->id, $ec->ue_id);
    }

    // Validation du code UE (format UExx)
    public function test_validation_code_ue()
    {
        $ue = UE::factory()->create(['code' => 'UE12']);
        
        $this->assertMatchesRegularExpression('/^UE[0-9]{2}$/', $ue->code);
    }

    // Vérification du semestre
    public function test_verification_semestre()
    {
        $ue = UE::factory()->create(['semestre' => 1]);

        $this->assertTrue($ue->semestre >= 1 && $ue->semestre <= 6);
    }
}
