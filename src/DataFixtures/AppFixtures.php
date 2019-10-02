<?php
/**
 * Created by PhpStorm.
 * User: BahaEddine
 * Date: 22-Feb-19
 * Time: 12:35 PM
 */

namespace DataFixtures;
use AppBundle\Entity\Agence;
use AppBundle\Entity\Agent;
use AppBundle\Entity\Assure;
use AppBundle\Entity\Compagnie;
use AppBundle\Entity\Expert;
use AppBundle\Entity\GarantieComplementaire;
use AppBundle\Entity\Police;
use AppBundle\Entity\PrimeRC;
use AppBundle\Entity\User;
use AppBundle\Entity\Vehicule;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const DOMAIN = "@assurance.tn";
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /* Compagnie */
        $gat = new Compagnie('gat.respo','gat@gmail.com','ROLE_COMPAGNIE');
        $gat->setPassword('$2y$13$Xj66JMgO1mJTZel48E8Ic.hf.M/FdwKZ.fGsAUKnKEEOEjIDKzh26');
        $gat->setNomCompagnie('GAT');
        $gat->setAdresse('Ariana');
        $gat->setFixe('12345678');
        $gat->setFax('12345678');
        $gat->setSite('gat.tn');
        $gat->setEnabled(true);
        $manager->persist($gat);
        /* Agences */
        $gat_ariana = new Agence();
        $gat_ariana->setZone('Ariana');
        $gat_ariana->setNbrEmployer(12);
        $gat_ariana->setTelephone('123456');
        $gat_ariana->setFax('12345678');
        $gat_ariana->setCompagnie($gat);
        $manager->persist($gat_ariana);
        /* Agents */
        /* Création de l'agent general */
        $agent_general = new Agent('agent_'.preg_replace('/\s+/', '', $gat_ariana->getCompagnie()).'_'.preg_replace('/\s+/', '', $gat_ariana->getZone()),'agent_'.preg_replace('/\s+/', '', $gat_ariana->getCompagnie()).'_'.preg_replace('/\s+/', '', $gat_ariana->getZone()).self::DOMAIN,'ROLE_AGENT_GENERAL');
        $agent_general->setPassword('$2y$13$Xj66JMgO1mJTZel48E8Ic.hf.M/FdwKZ.fGsAUKnKEEOEjIDKzh26');
        $agent_general->setAgence($gat_ariana);
        $agent_general->setEnabled(true);
        $manager->persist($agent_general);
        /* Experts */
        $expert_ariana = new Expert('expert_ariana','expert_ariana'.self::DOMAIN,'ROLE_EXPERT');
        $expert_ariana->setPassword('$2y$13$Xj66JMgO1mJTZel48E8Ic.hf.M/FdwKZ.fGsAUKnKEEOEjIDKzh26');
        $expert_ariana->setEnabled(true);
        $expert_ariana->setCinExp('09135478');
        $expert_ariana->setNomExp('Ayadi');
        $expert_ariana->setPrenomExp('BahaEddine');
        $expert_ariana->setTelExp('12345678');
        $expert_ariana->setZoneExp('Ariana');
        $manager->persist($expert_ariana);
        $expert_tunis = new Expert('expert_tunis','expert_tunis'.self::DOMAIN,'ROLE_EXPERT');
        $expert_tunis->setPassword('$2y$13$Xj66JMgO1mJTZel48E8Ic.hf.M/FdwKZ.fGsAUKnKEEOEjIDKzh26');
        $expert_tunis->setEnabled(true);
        $expert_tunis->setCinExp('09156432');
        $expert_tunis->setNomExp('Zitoun');
        $expert_tunis->setPrenomExp('Skander');
        $expert_tunis->setTelExp('12345678');
        $expert_tunis->setZoneExp('Tunis');
        $manager->persist($expert_tunis);
        /* PrimeRC */
        $prime_one = new PrimeRC();
        $prime_one->setPrix(133000);
        $prime_one->setPuissanceFiscale(2);
        $manager->persist($prime_one);
        $prime_two = new PrimeRC();
        $prime_two->setPrix(155000);
        $prime_two->setPuissanceFiscale(3);
        $manager->persist($prime_two);
        $prime_three = new PrimeRC();
        $prime_three->setPrix(155000);
        $prime_three->setPuissanceFiscale(4);
        $manager->persist($prime_three);
        $prime_four = new PrimeRC();
        $prime_four->setPrix(194000);
        $prime_four->setPuissanceFiscale(5);
        $manager->persist($prime_four);
        $prime_five = new PrimeRC();
        $prime_five->setPrix(194000);
        $prime_five->setPuissanceFiscale(6);
        $manager->persist($prime_five);
        $prime_six = new PrimeRC();
        $prime_six->setPrix(280000);
        $prime_six->setPuissanceFiscale(7);
        $manager->persist($prime_six);
        $prime_seven = new PrimeRC();
        $prime_seven->setPrix(280000);
        $prime_seven->setPuissanceFiscale(8);
        $manager->persist($prime_seven);
        /* Assure Physique + Police + Vehicule */
        $v = new Vehicule("180TN3215", "Peugeot", "4", "Essence");
        $v->setValVenale("20000");
        $v->setPrimeRC($prime_three);
        $contrat = new Police();
        $contrat->setClasse(8);
        $contrat->setCoefClasse(0.7);
        $contrat->setDateEffetPolice(new DateTime('now'));
        $contrat->setAgence($gat_ariana);
        $assure = new Assure('assure_ariana','assure_ariana'.self::DOMAIN,'ROLE_ASSURE');
        $assure->setPassword('$2y$13$Xj66JMgO1mJTZel48E8Ic.hf.M/FdwKZ.fGsAUKnKEEOEjIDKzh26');
        $assure->setEnabled(true);
        $assure->setCin('11917217');
        $assure->setNom('Omrani');
        $assure->setPrenom('Mahmoud');
        $assure->setProfession('Software Developer');
        $assure->setTel('123456');
        $assure->setFax('123456');
        $contrat->setCodeAssure($assure);
        $assure->setContrats([$contrat]);
        $v->setRefContrat($contrat);
        $v->setDateCircule(new DateTime('now'));
        $manager->persist($assure);
        $manager->persist($contrat);
        $manager->persist($v);
        /* Garanties Complémentaires */
        $vol_gat = new GarantieComplementaire();
        $vol_gat->setNom('vol');
        $vol_gat->setPrimeDeBase(15000);
        $vol_gat->setSurprime(0.026);
        $vol_gat->setCompagnie($gat);
        $manager->persist($vol_gat);
        $incendie_gat = new GarantieComplementaire();
        $incendie_gat->setNom('Incendie');
        $incendie_gat->setPrimeDeBase(10000);
        $incendie_gat->setSurprime(0.045);
        $incendie_gat->setCompagnie($gat);
        $manager->persist($incendie_gat);
        $defense_gat = new GarantieComplementaire();
        $defense_gat->setNom('Defense');
        $defense_gat->setTarifDeBase(30000);
        $defense_gat->setCompagnie($gat);
        $manager->persist($defense_gat);

        #mmmmm
        $v1 = new Vehicule("888TN9999", "Peugeot", "4", "diesel");
        $v1->setValVenale("10000");
        $v1->setPrimeRC($prime_three);
        $contrat1 = new Police();
        $contrat1->setClasse(8);
        $contrat1->setCoefClasse(0.7);
        $contrat1->setDateEffetPolice(new DateTime('now'));
        $contrat1->setAgence($gat_ariana);
        $assure1 = new Assure('assure_maroc','assure_maroc'.self::DOMAIN,'ROLE_ASSURE');
        $assure1->setPassword('$2y$13$Xj66JMgO1mJTZel48E8Ic.hf.M/FdwKZ.fGsAUKnKEEOEjIDKzh26');
        $assure1->setEnabled(true);
        $assure1->setCin('07477');
        $assure1->setNom('pi');
        $assure1->setPrenom('dev');
        $assure1->setProfession('Software Developer');
        $assure1->setTel('1234567');
        $assure1->setFax('1234567');
        $contrat1->setCodeAssure($assure1);
        $assure1->setContrats([$contrat1]);
        $v1->setRefContrat($contrat1);
        $v1->setDateCircule(new DateTime('now'));
        $manager->persist($assure1);
        $manager->persist($contrat1);
        $manager->persist($v1);

        $manager->flush();
    }
}