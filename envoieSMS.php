<?php 

require_once 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');

  


  $req = getTrajet($bdd);
 // var_dump($req);



function getTrajet($bdd) {
    $now = new DateTime("now", new DateTimeZone('Europe/Paris'));
    $req = $bdd->getPDO()->prepare('SELECT * FROM trajet WHERE state = :state');
    $req->execute(array('state' => "Pas commencé"));
    while ($unTrajet = $req->fetch()) {
      
        $dateTrajet = new DateTime($unTrajet["heureDebut"], new DateTimeZone('Europe/Paris'));
        $interval = $dateTrajet->diff($now);
        var_dump($interval);
        if ($interval->y == 0 && $interval->m == 0 && $interval->d == 0 && $interval->y == 0 && $interval->h == 0 && $interval->i == 30 )
        {
            $phoneNumber = getNumero($bdd,$unTrajet['idClient']);
            if (isset($phoneNumber) && !empty($phoneNumber) && $phoneNumber != null) {
            $unChauffeur = getNumeroChauffeur($bdd,$unTrajet['idChauffeur']);
            if (isset($unChauffeur['phoneNumber']) && !empty($unChauffeur['phoneNumber']) && $unChauffeur['phoneNumber'] != null) {
                $unTrajet['debut'] = str_replace(' ', '+', $unTrajet['debut']);
                $unTrajet['fin'] = str_replace(' ', '+', $unTrajet['fin']);
                $message ="Votre+trajet+de+%0a+".$unTrajet["debut"]."+%3D%3E+".$unTrajet["fin"]."+%0a+commence+le+".$dateDebut."+%E0++".$heureDebut."+jusqu'%E0+".$dateFin."+%E0++".$heureFin."+%0a+Votre+chauffeur+s'appele+".$unChauffeur['first_name']."+".$unChauffeur['last_name']."";
                $sms = file_get_contents("https://api.smsmode.com/http/1.6/sendSMS.do?pseudo=ripESGI&pass=Rideinpride77!&message=".$message."&numero=".$phoneNumber."");
            }
            else 
            {
                $datefmt = new IntlDateFormatter('fr_FR', NULL, NULL, NULL, NULL, 'dd MMMM yyyy');

                $unTrajet['debut'] = str_replace(' ', '+', $unTrajet['debut']);
                $unTrajet['fin'] = str_replace(' ', '+', $unTrajet['fin']);

                $unTrajet['heureDebut'] = new DateTime($unTrajet['heureDebut'], new DateTimeZone('Europe/Paris'));
                $unTrajet['heureFin'] = new DateTime($unTrajet['heureFin'], new DateTimeZone('Europe/Paris'));

                $heureDebut = $unTrajet['heureDebut']->format('H:i');
                $heureFin = $unTrajet['heureFin']->format('H:i');

                $newHeure = convertHeure($bdd,$heureDebut,$heureFin);
                $heureDebut = $newHeure[0];
                $heureFin = $newHeure[1];

                $dateDebut = $datefmt->format($unTrajet['heureDebut']);
                $dateFin = $datefmt->format($unTrajet['heureFin']);

                $dateDebut = str_replace(" ","+",$dateDebut);
                $dateFin = str_replace(" ","+",$dateFin);

                $message ="Votre+trajet+de+%0a+".$unTrajet["debut"]."+%3D%3E+".$unTrajet["fin"]."+%0a+commence+le+".$dateDebut."+%E0++".$heureDebut."+jusqu'%E0+".$dateFin."+%E0++".$heureFin."+%0a+Votre+chauffeur+s'appele+".$unChauffeur['first_name']."+".$unChauffeur['last_name']."";
                $sms = file_get_contents("https://api.smsmode.com/http/1.6/sendSMS.do?pseudo=ripESGI&pass=Rideinpride77!&message=".$message."&numero=".$phoneNumber."");
            }

        }

            
        }

    }
    
}

function getNumero($bdd,$id) {
    $req = $bdd->getPDO()->prepare('SELECT phoneNumber FROM users WHERE id = :id');
    $req->execute(array('id' => $id));
    $unClient = $req->fetch();
    return $unClient['phoneNumber'];

}

function getNumeroChauffeur($bdd,$id) {
    $req = $bdd->getPDO()->prepare('SELECT * FROM collaborateurs WHERE idCollaborateurs = :idCollaborateurs');
    $req->execute(array('idCollaborateurs' => $id));
    $unChauffeur = $req->fetch();
    return $unChauffeur;

}

function convertHeure($bdd,$heureDebut,$heureFin) {

   

    $heureDebut = explode(":",$heureDebut);
    $heureDebut = $heureDebut[0] ." heures et ".$heureDebut[1]." minutes";
    $heureDebut = str_replace(" ","+",$heureDebut);

    $heureFin = explode(":",$heureFin);
    $heureFin = $heureFin[0] ." heures et ".$heureFin[1]." minutes";
    $heureFin = str_replace(" ","+",$heureFin);
    $array = [];
    array_push($array,$heureDebut);
    array_push($array,$heureFin);
    return $array;


}
?>