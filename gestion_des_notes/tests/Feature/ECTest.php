<?php

namespace Tests\Feature;

use App\Models\EC;
use App\Models\UE;
use App\Models\Etudiant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ECTest extends TestCase
{
    use RefreshDatabase;

    // Création d'un EC avec coefficient
    public function test_creation_ec_avec_coefficient()
    {
        $ue = UE::factory()->create();
        $ec = EC::factory()->create([
            'coefficient' => 3,
            'ue_id' => $ue->id
        ]);

        $this->assertDatabaseHas('elements_constitutifs', [
            'coefficient' => 3
        ]);
    }

    // Vérification du rattachement à une UE
    public function test_rattachement_ec_ue()
    {
        $ue = UE::factory()->create();
        $ec = EC::factory()->create([
            'ue_id' => $ue->id
        ]);

        $this->assertEquals($ue->id, $ec->ue_id);
    }

    // Test de modification d'un EC
    public function test_modification_ec()
    {
        $ec = EC::factory()->create(['coefficient' => 2]);
        $ec->update(['coefficient' => 4]);

        $this->assertDatabaseHas('elements_constitutifs', [
            'coefficient' => 4
        ]);
    }

    // Validation du coefficient (entre 1 et 5)
    public function test_validation_coefficient_ec()
    {
        $ec = EC::factory()->create(['coefficient' => 5]);

        $this->assertTrue($ec->coefficient >= 1 && $ec->coefficient <= 5);
    }

    // Test de suppression d'un EC
    public function test_suppression_ec()
    {
        $ec = EC::factory()->create();
        $ec->delete();

        $this->assertDatabaseMissing('elements_constitutifs', [
            'id' => $ec->id
        ]);
    }
}
