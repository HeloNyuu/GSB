<?php
include 'bd.inc.php';

function VerifyUt($email)
{
    try 
        {
        $monPdo = connexionPDO();
        $stm = $monPdo -> prepare("SELECT Mdp_co,Mail_co,grade FROM compte WHERE Mail_co = ? " );
        $stm -> bindValue (1,$email);
        $stm -> execute();
        $t=$stm->fetchAll();
        if (count($t)>0){
            return $t[0];
        }

        return null;
        }  
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
}

function getInfoVisiteur($email){
        try 
        {
        $monPdo = connexionPDO();
        $stm = $monPdo -> prepare("SELECT Mdp_co,Mail_co,grade,mat_vis FROM compte WHERE Mail_co = ? " );
        $stm -> bindValue (1,$email);
        $stm -> execute();
        $LG=$stm->fetchAll();
        return $LG;
        }  
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
}
function getInfoVis(){
        try 
        {
        $monPdo = connexionPDO();
        $stm = $monPdo -> prepare("SELECT * FROM  visiteur " );
        $stm -> execute();
        $LG=$stm->fetchAll();
        return $LG;
        }  
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
}
function getNom($mat){
    try{
    $monPdo = connexionPDO();
    $stm = $monPdo -> prepare("SELECT Vis_PRENOM,Vis_NOM FROM visiteur vi INNER JOIN compte cp ON vi.VIS_MATRICULE = cp.mat_vis where cp.mat_vis = ? ");
     $stm -> bindValue (1,$mat);
        $stm -> execute();
        $LG=$stm->fetchAll();
        return $LG;
        }  
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
}

function getLesMedicaments(){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT MED_DEPOTLEGAL,MED_NOMCOMMERCIAL from Medicament';
            $res = $monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
        
    }

    function getProduitsPrésente($visMat,$rapNum){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT produit1,produit2 from presente where VIS_MATRICULE ="'.$visMat.'" AND RAP_NUM='.$rapNum.' ';
            $res = $monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
        
    }

    function getLesDetailsDesMedicaments($t){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT MED_DEPOTLEGAL,MED_NOMCOMMERCIAL,medicament.FAM_CODE,MED_COMPOSITION,MED_EFFETS,MED_CONTREINDIC,FAM_LIBELLE 
                    from Medicament 
                    inner join famille
                    on Medicament.FAM_CODE=famille.FAM_CODE
                    where MED_NOMCOMMERCIAL="'.$t.'"';
            //revoir la sécurité
            $res = $monPdo->query($req);
            $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }

    function getLesMotifs(){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT id_motif,libelle_motif from motif';
            $res = $monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
        
    }

    function getEchantillionOffert($visMat,$rapNum){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT MED_DEPOTLEGAL,OFF_QTE 
                    from offrir
                    inner join rapport_visite
                    on offrir.VIS_MATRICULE=rapport_visite.VIS_MATRICULE
                    where offrir.VIS_MATRICULE="'.$visMat.'" AND offrir.RAP_NUM='.$rapNum.'';
            $res = $monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }

    function getNomMedicament($depoLeg){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT MED_NOMCOMMERCIAL 
                    from Medicament
                    where MED_DEPOTLEGAL="'.$depoLeg.'"';
            $res = $monPdo->query($req);
        $lesLignes = $res->fetch();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }

    

     function getLesDetailsDesPraticiens($t){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT PRA_NUM,PRA_NOM,PRA_PRENOM,PRA_ADRESSE,PRA_CP,PRA_VILLE,PRA_COEFNOTORIETE,PRA_COEFNOTORIETE,praticien.TYP_CODE,TYP_LIBELLE,TYP_LIEU
                    from praticien 
                    inner join type_praticien 
                    on praticien.TYP_CODE=type_praticien.TYP_CODE
                    where PRA_NOM="'.$t.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
            $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }

    function getLesDetailsDesPraticiensRapport($t,$dateDebut,$dateFin){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT VIS_MATRICULE,PRA_NUM,RAP_NUM,RAP_DATE,RAP_BILAN,RAP_MOTIF,saisieDef,remplacant
            from rapport_visite
            where VIS_MATRICULE="'.$t.'" AND RAP_DATE between "'.$dateDebut.'" and "'.$dateFin.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
            $lesLignes = $res->fetchAll();
        return $lesLignes;

        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }

    function getLesDetailsDesPraticiensRapport1($t){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT VIS_MATRICULE,PRA_NUM,RAP_NUM,RAP_DATE,RAP_BILAN,RAP_MOTIF,saisieDef,remplacant
            from rapport_visite
            where VIS_MATRICULE="'.$t.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
            $lesLignes = $res->fetchAll();
        return $lesLignes;

        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }
    function getRapportPartRegion($secteur){
        try{
            $monPdo = connexionPDO();
            $req=$monPdo->prepare('SELECT * FROM rapport_visite r INNER JOIN visiteur v ON v.VIS_MATRICULE = r.VIS_MATRICULE WHERE SEC_CODE = ? ');
            $req->bindValue(1,$secteur[0]);
            $req -> execute();
            $l = $req->fetchALL();
            return$l;
        }
        catch(PDOException $e)
        {
        print "Erreur !: " . $e->getMessage();
        die(); 
        }
    }
    function getSecteur($mail){
        try{
            $pdo = connexionPDO();
            $req=$pdo->prepare('SELECT SEC_CODE FROM visiteur v INNER JOIN compte c ON c.mat_vis=v.VIS_MATRICULE WHERE mail_co = ? ');
            $req->bindValue(1,$mail);
            $req -> execute();
            $LG=$req->fetch();
            return $LG;
        }
      catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }

   

    function getPraNom($t){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT pra_nom,PRA_PRENOM
            from praticien
            where pra_num="'.$t.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
            $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }

    function getNumRapExiste($vis_matNumExist,$rap_numExit){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT rap_num
            from rapport_visite
            where VIS_MATRICULE="'.$vis_matNumExist.'" and rapNum="'.$vis_matNumExist.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
            $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }


    function getRapport($visMat,$rapNum){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT rapport_visite.VIS_MATRICULE,PRA_NUM,rapport_visite.RAP_NUM,RAP_DATE,RAP_BILAN,RAP_MOTIF,saisieDef,remplacant,produit1,produit2
            from rapport_visite
            inner join presente
            on rapport_visite.rap_num = presente.rap_num
         
            where rapport_visite.VIS_MATRICULE="'.$visMat.'" and rapport_visite.RAP_NUM="'.$rapNum.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
            $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }

    function getMedicamentOffert($visMat,$rapNum){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT MED_DEPOTLEGAL,OFF_QTE
            from offrir
            where VIS_MATRICULE="'.$visMat.'" and RAP_NUM="'.$rapNum.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
            $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }





function getPraNum($t){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT pra_num
            from praticien
            where pra_nom="'.$t.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
            $lesLignes = $res->fetch();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }



    function getVisMatConnecte($t){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT mat_vis
            from compte
            where mail_co="'.$t.'"'; 
            //revoir la sécurité
            $res = $monPdo->query($req);
            $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }



   

    function getLesPraticiens(){
        try{
            $monPdo = connexionPDO();
            $req = 'SELECT PRA_NUM,PRA_NOM,PRA_PRENOM from praticien';
            $res = $monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
        } 
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }
    function getGrade($matVis){
        try{
            $monPdo = connexionPDO();
            $stm = $monPdo -> prepare("SELECT grade FROM compte  where mat_vis = ? ");
     $stm -> bindValue (1,$matVis);
        $stm -> execute();
        $LG=$stm->fetchAll();
        return $LG;
        }  
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }
    function getListGrade(){
        try 
        {
        $monPdo = connexionPDO();
        $stm = $monPdo -> prepare("SELECT * FROM  grade " );
        $stm -> execute();
        $LG=$stm->fetchAll();
        return $LG;
        }  
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }

    function getInfComptes(){
        try 
        {
        $monPdo = connexionPDO();
        $stm = $monPdo -> prepare("SELECT c.id_Co, c.Mail_co, g.type_Grade AS grade, c.mat_vis 
                                    FROM compte c
                                    INNER JOIN grade g ON c.grade = g.id_Grade " );
        $stm -> execute();
        $LG=$stm->fetchAll();
        return $LG;
        }  
        catch (PDOException $e) 
        {
        print "Erreur !: " . $e->getMessage();
        die();
        }
    }