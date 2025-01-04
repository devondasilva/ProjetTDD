<?php

namespace Tests\Feature;

use App\Models\Etudiant;
use App\Models\UE;
use App\Models\EC;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    // Validation d'une UE (moyenne ≥ 10)
    public function test_validation_ue()
    {
        $etudiant = Etudiant::factory()->create();
        $ue = UE::factory()->create();
        $ec = EC::factory()->create(['ue_id' => $ue->id, 'coefficient' => 2]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 12,
            'session' => 'normale'
        ]);

        $this->assertTrue($ue->estValidee($etudiant));
    }

    // Test de compensation entre UEs
    public function test_compensation_ues()
    {
        $ue = \App\Models\UE::factory()->create(['credits_ects' => 6]);
        $note = \App\Models\Note::factory()->create(['valeur' => 8, 'ue_id' => $ue->id]); // Note insuffisante
    
        $response = $this->postJson('/api/compensations', [
            'etudiant_id' => $note->etudiant_id,
        ]);
    
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Compensation appliquée',
            'compensation' => true,
        ]);
    }
    

    // Calcul des ECTS acquis
    public function test_calcul_ects_acquis()
{
    $etudiant = \App\Models\Etudiant::factory()->create();

    // Ajouter des notes validées pour l’étudiant
    \App\Models\Note::factory()->create(['valeur' => 12, 'credits_ects' => 6, 'etudiant_id' => $etudiant->id]);
    \App\Models\Note::factory()->create(['valeur' => 14, 'credits_ects' => 4, 'etudiant_id' => $etudiant->id]);

    $response = $this->getJson("/api/etudiants/{$etudiant->id}/ects");

    $response->assertStatus(200);
    $response->assertJson([
        'ects_acquis' => 10, // Somme des crédits validés
    ]);
}


    // Validation du semestre
    public function test_validation_semestre()
    {
        $etudiant = Etudiant::factory()->create();
        $ue = UE::factory()->create();
        $ec = EC::factory()->create(['ue_id' => $ue->id, 'coefficient' => 2]);

        Note::create(['etudiant_id' => $etudiant->id, 'ec_id' => $ec->id, 'note' => 10, 'session' => 'normale']);

        $this->assertTrue($etudiant->validationSemestre());
    }

    // Test de passage à l'année suivante
    public function test_passage_annee_suivante()
    {
        $etudiant = Etudiant::factory()->create();
        $ue1 = UE::factory()->create(['credits_ects' => 6]);
        $ue2 = UE::factory()->create(['credits_ects' => 6]);
        $ec1 = EC::factory()->create(['ue_id' => $ue1->id, 'coefficient' => 2]);
        $ec2 = EC::factory()->create(['ue_id' => $ue2->id, 'coefficient' => 3]);

        Note::create(['etudiant_id' => $etudiant->id, 'ec_id' => $ec1->id, 'note' => 12, 'session' => 'normale']);
        Note::create(['etudiant_id' => $etudiant->id, 'ec_id' => $ec2->id, 'note' => 14, 'session' => 'normale']);

        $this->assertTrue($etudiant->peutPasserAnneeSuivante());
    }
}
