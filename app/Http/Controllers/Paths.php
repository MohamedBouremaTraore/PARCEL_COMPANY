<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Paths;
use Illuminate\Support\Facades\DB;
use App\Models\Clients;
use App\Models\Colis;
use App\Models\Transactons;

class Paths extends Controller
{
 
   function welcome(){
        $message=" ";
        $status=" ";
        return view('welcome',compact('message','status'));
   }


   function login(Request $request){
       
     $email = $request->input('email');
     $password = $request->input('password');
         /////Recuperation des donnees des clients dans la base de donnee/////
         $users = DB::table('clients')
         ->where('email',$email)
         ->where('password',$password)
         ->get();

         ///// switch client between different dashboard
         if(count($users)==0){
          $message="Mots de passe ou utilisateur incorrects ";
          $status="indefined ";
          return view('welcome',compact('message','status'));
         }else{
          switch($users[0]->type){
               case "client" :{
               /////Recuperation des colis du client/////
               $colis = DB::table('colis')
               ->where('id_clients',$users[0]->id)
               ->where('status','ramassage')
               ->get();
               $nbre_livraison= DB::table('Colis')
               ->where('id_clients',$users[0]->id)
               ->where('status','livraison')
               ->count();
              
               $nbre_ramassage= DB::table('Colis')
               ->where('id_clients',$users[0]->id)
               ->where('status','ramassage')
               ->count();
               $status=" ";
               $message=" ";
                    return view('./FrontEnd/CLIENT/ramassage',compact(
                         'colis',
                         'users',
                         'nbre_livraison',
                         'nbre_ramassage',
                         'message',
                         'status'
                    ));
                    break;
               }
                     
                case "livreur" :{
                     // les colis qui sont assignés au livreur dans la table transaction
                    $transactions = DB::table('transactons')
                    ->where('id_clients',$users[0]->id)
                    ->get();

                    // rassembler les transtions du client dans seul table c.a.d les id du colis assignés
                    $tab = array(
                    );
                    foreach ($transactions as $key => $value) {
                         array_push($tab,$value->id_colis);
                    }
                    
                     // recuperer les colis en fonctions des transactions
                     

                     $colis = DB::table('colis')
                     ->whereIn('id', $tab)
                     ->get();

                    return view('./FrontEnd/DELIVER/deliver',compact(
                         'users',
                         'colis',
                         'transactions'
                    ));
                    break;
                }
                   
                case "admin" :{
                    $colis = DB::table('Colis')
                    ->where('etat','ramassage')
                    ->orWhere('etat', 'livraison')
                    ->get();
                    return view('./FrontEnd/ADMIN/admin',compact(
                         'users',
                         'colis'
                    ));
                    break;
                }
                    
                default : 
                   return view('welcome');
          }
         }
        
   }


   function register(){
     $message=" ";
     $status=" ";
     return view('./FrontEnd/register',compact('message','status'));
   }
   // gestion de l'enregistrement
   function handleRegister(Request $request){
     $email = $request->input('email');
     $password = $request->input('password');
   //  $username = $request->input('username');
     $confirm = $request->input('confirm');
     $nom_commercial = $request->input('username');
     if( ($password != $confirm) ){
          // si l'enregistrement n'a pas recu
          $message="Les mots de passes ne correspondent pas";
          $status="different";
          return view('./FrontEnd/register',compact('message','status'));
     }else{
          // si l'un des champs est vide
          if((empty($password))  || (empty($email)) || (empty($nom_commercial)) || (empty($confirm)) ){
               $message="veuillez remplir tous les champs";
               $status="vide";
               return view('./FrontEnd/register',compact('message','status'));
          }
          else{

               $users = DB::table('clients')
               ->where('email',$email)
               ->orwhere('username',$nom_commercial)
               ->get();
               if(count($users)>0){

                    $message="Nom commercial ou mot de passe existe déja";
                    $status="existe";
                    return view('./FrontEnd/register',compact('message','status'));

               }else{
 // redirection vers la page de connection
 $message="Compte créé avec succès !";
 $status="succes";
 // enregistrer les donnees dans la BD

 $Client_id = DB::table('clients')
             ->select('id')
              ->max('id');
 $Client = new Clients;
 $Client->id =$Client_id+1;
 $Client->username = $nom_commercial;
 $Client->password = $password;
 $Client->email = $email;
 $Client->type = "client";
 $Client->created_at = now();
 $Client->updated_at = now();
 $Client->save();
 return view('welcome',compact('message','status'));
          }
     }
}
   }

   //CLIENT
   function ramassage($id){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

     $colis = DB::table('Colis')
     ->where('id_clients',$users[0]->id)
     ->where('status','ramassage')
     ->get();

     $nbre_livraison= DB::table('Colis')
     ->where('id_clients',$users[0]->id)
     ->where('status','livraison')
     ->count();

     $nbre_ramassage= DB::table('Colis')
     ->where('id_clients',$users[0]->id)
     ->where('status','ramassage')
     ->count();

     $status=" ";
     $message=" ";
     return view('./FrontEnd/CLIENT/ramassage',compact(
          'users',
          'colis',
          'nbre_ramassage',
          'nbre_livraison',
          'message',
          'status'
     ));
   }

   function livraison($id){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     $colis = DB::table('Colis')
     ->where('id_clients',$users[0]->id)
     ->where('status','ramassage')
     ->get();

     $nbre_livraison= DB::table('Colis')
     ->where('id_clients',$users[0]->id)
     ->where('status','livraison')
     ->count();

     $nbre_ramassage= DB::table('Colis')
     ->where('id_clients',$users[0]->id)
     ->where('status','ramassage')
     ->count();

     $status=" ";
     $message=" ";

     return view('./FrontEnd/CLIENT/livraison',compact(
          'users',
          'colis',
          'nbre_ramassage',
          'nbre_livraison',
          'message',
          'status'
     ));
   }

   function liste_ramassage($id){
     $colis = DB::table('colis')
     ->where('id_clients',$id)
     ->where('status','ramassage')
     ->get();
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

     $nbre_livraison= DB::table('Colis')
     ->where('id_clients',$users[0]->id)
     ->where('status','livraison')
     ->count();

     $nbre_ramassage= DB::table('Colis')
     ->where('id_clients',$users[0]->id)
     ->where('status','ramassage')
     ->count();
     $status=" ";
     $message=" ";

     return view('./FrontEnd/CLIENT/liste_ramassage',compact(
          'users',
          'colis',
          'nbre_ramassage',
          'nbre_livraison',
          'message',
          'status'
     ));
   }

  function liste_livraison($id){
     $colis = DB::table('colis')
     ->where('id_clients',$id)
     ->where('status','livraison')
     ->get();
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

     $nbre_livraison= DB::table('Colis')
     ->where('id_clients',$users[0]->id)
     ->where('status','livraison')
     ->count();

     $nbre_ramassage= DB::table('Colis')
     ->where('id_clients',$users[0]->id)
     ->where('status','ramassage')
     ->count();
     $status=" ";
     $message=" ";
     
     return view('./FrontEnd/CLIENT/liste_ramassage',compact(
          'users',
          'colis',
          'nbre_ramassage',
          'nbre_livraison',
          'message',
          'status'
     ));
   }

   function add_ramassage(Request $request){
     $id = $request->input('id');
     $reference = $request->input('reference');
     $destinataire = $request->input('destinataire');
     $telephone = $request->input('telephone');
     $produit = $request->input('produit');
     $note = $request->input('note');
     $ville = $request->input('ville');
     $prix = $request->input('prix');
     $options_rembourser = $request->input('options_rembourser');
     $options_ouvrir = $request->input('options_ouvrir');
     $options_changer = $request->input('options_changer');

     if(empty($id) || empty($reference) || empty($destinataire) || empty($telephone) || empty($produit) || empty($note) || empty($ville)){
          $colis = DB::table('colis')
          ->where('id_clients',$id)
          ->where('status','ramassage')
          ->get();
          $users = DB::table('clients')
          ->where('id',$id)
          ->get();
     
          $nbre_livraison= DB::table('Colis')
          ->where('id_clients',$users[0]->id)
          ->where('status','livraison')
          ->count();
     
          $nbre_ramassage= DB::table('Colis')
          ->where('id_clients',$users[0]->id)
          ->where('status','ramassage')
          ->count();
     $message='veuillez remplir tous les champs';
     $status="vide";
          return view('./FrontEnd/CLIENT/ramassage',compact(
               'users',
               'colis',
               'nbre_ramassage',
               'nbre_livraison',
               'message',
               'status'
          ));
     }else{
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     $colis = DB::table('Colis')
     ->get();
     $Colis_id = DB::table('colis')
             ->select('id')
              ->max('id');

// tester si les champs ne sont pas vide ??b

     $Colis = new Colis;
   $Colis->id =$Colis_id+1;
   $Colis->id_clients = $id;
 $Colis->reference = $reference;
 $Colis->etat = "ramassage";
 $Colis->status = "ramassage";
 $Colis->destinateur = $destinataire;
 $Colis->telephone = $telephone;
 $Colis->produit = $produit;
 $Colis->ville = $ville;
 $Colis->prix = $prix;
 $Colis->options = "$options_ouvrir $options_rembourser $options_changer";
 $Colis->commentaire =$note;
 $Colis->created_at = now();
 $Colis->updated_at = now();
 $Colis->save();

 $nbre_livraison= DB::table('Colis')
 ->where('id_clients',$users[0]->id)
 ->where('status','livraison')
 ->count();

 $nbre_ramassage= DB::table('Colis')
 ->where('id_clients',$users[0]->id)
 ->where('status','ramassage')
 ->count();
 $message='Modification enregistrée';
     $status="modifier";
     return view('./FrontEnd/Client/ramassage',compact(
          'users',
          'colis',
          'nbre_ramassage',
          'nbre_livraison',
          'message',
          'status'
     ));
}
   }

   
   function add_livraison(Request $request){
     $id = $request->input('id');
     $reference = $request->input('reference');
     $destinataire = $request->input('destinataire');
     $telephone = $request->input('telephone');
     $produit = $request->input('produit');
     $note = $request->input('note');
     $ville = $request->input('ville');
     $prix = $request->input('prix');
     $options_rembourser = $request->input('options_rembourser');
     $options_ouvrir = $request->input('options_ouvrir');
     $options_changer = $request->input('options_changer');

     if(empty($id) || empty($reference) || empty($destinataire) || empty($telephone) || empty($produit) || empty($note) || empty($ville)){
    
          $users = DB::table('clients')
          ->where('id',$id)
          ->get();
          $colis = DB::table('Colis')
          ->where('id_clients',$users[0]->id)
          ->where('status','ramassage')
          ->get();
     
          $nbre_livraison= DB::table('Colis')
          ->where('id_clients',$users[0]->id)
          ->where('status','livraison')
          ->count();
     
          $nbre_ramassage= DB::table('Colis')
          ->where('id_clients',$users[0]->id)
          ->where('status','ramassage')
          ->count();
     
          $status="vide";
          $message="veuillez remplir tous les champs";
          return view('./FrontEnd/CLIENT/livraison',compact(
               'users',
               'colis',
               'nbre_ramassage',
               'nbre_livraison',
               'message',
               'status'
          ));
     }else{

     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     $colis = DB::table('Colis')
     ->get();
     $Colis_id = DB::table('colis')
             ->select('id')
              ->max('id');

     $Colis = new Colis;
   $Colis->id =$Colis_id+1;
   $Colis->id_clients = $id;
 $Colis->reference = $reference;
 $Colis->etat = "livraison";
 $Colis->status = "livraison";
 $Colis->destinateur = $destinataire;
 $Colis->telephone = $telephone;
 $Colis->produit = $produit;
 $Colis->ville = $ville;
 $Colis->prix = $prix;
 $Colis->options = "$options_ouvrir $options_rembourser $options_changer";
 $Colis->commentaire =$note;
 $Colis->created_at = now();
 $Colis->updated_at = now();
 $Colis->save();

 $nbre_livraison= DB::table('Colis')
 ->where('id_clients',$users[0]->id)
 ->where('status','livraison')
 ->count();

 $nbre_ramassage= DB::table('Colis')
 ->where('id_clients',$users[0]->id)
 ->where('status','ramassage')
 ->count();
 $status="modifier";
          $message="Modification avec succes";

     return view('./FrontEnd/Client/ramassage',compact(
          'users',
          'colis',
          'nbre_livraison',
          'nbre_ramassage',
          'message',
          'status'
     ));
}
   }

   // ADMIN
   function colis_en_traitement($id){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     $colis = DB::table('Colis')
     ->where('etat','<>','ramassage')
     ->where('etat','<>','livraison')
     ->get();
        return view('./FrontEnd/ADMIN/colis_en_traitement',compact(
             'users',
             'colis'
        ));
   }

   function nouveau_colis($id){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     $colis = DB::table('Colis')
     ->where('etat','ramassage')
     ->orWhere('etat', 'livraison')
     ->get();
     return view('./FrontEnd/ADMIN/admin',compact(
          'users',
          'colis'
     ));
}

function liste_client($id){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     $users_list= DB::table('clients')
     ->where('type','client')
     ->get();
     return view('./FrontEnd/ADMIN/liste_client',compact(
          'users',
          'users_list'
     ));
}

function liste_livreur($id){
     $users_list= DB::table('clients')
     ->where('type','livreur')
     ->get();
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     //dd($users_list);
     return view('./FrontEnd/ADMIN/liste_livreur',compact(
          'users',
          'users_list'
     ));

}

function ajouter_livreur($id){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     return view('./FrontEnd/ADMIN/ajouter_livreur',compact(
          'users'
     ));
}

function ajouter_client($id){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     return view('./FrontEnd/ADMIN/ajouter_client',compact(
          'users'
     ));
}

function add_client(Request $request){
     $id = $request->input('id');
     $password = $request->input('password');
     $email = $request->input('email');
     $nom_commercial = $request->input('nom_commercial');
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
    
     if(empty($password) || empty($email) || empty($nom_commercial) ){
          $colis = DB::table('Colis')
          ->where('status','ramassage')
          ->orWhere('status', 'livraison')
          ->get();

          return view('./FrontEnd/ADMIN/admin',compact(
               'users',
               'colis'
          ));
     }else{
          $colis = DB::table('Colis')
          ->where('status','ramassage')
          ->orWhere('status', 'livraison')
          ->get();

     $Client_id = DB::table('clients')
             ->select('id')
              ->max('id');
     $Client = new Clients;
 $Client->id =$Client_id+1;
 $Client->username = $nom_commercial;
 $Client->password = $password;
 $Client->email = $email;
 $Client->type = "client";
 $Client->created_at = now();
 $Client->updated_at = now();
 $Client->save();
     return view('./FrontEnd/ADMIN/admin',compact(
          'users',
          'colis'
     ));
}

}

function add_livreur(Request $request){
     $id = $request->input('id');
     $password = $request->input('password');
     $email = $request->input('email');
     $nom_commercial = $request->input('nom_commercial');
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

     
     if(empty($password) || empty($email) || empty($nom_commercial) ){
          $colis = DB::table('Colis')
          ->where('etat','ramassage')
          ->orWhere('etat', 'livraison')
          ->get();

          return view('./FrontEnd/ADMIN/admin',compact(
               'users',
               'colis'
          ));
     }else{
          $colis = DB::table('Colis')
          ->where('etat','ramassage')
          ->orWhere('etat', 'livraison')
          ->get();

     $Client_id = DB::table('clients')
             ->select('id')
              ->max('id');

     $Client = new Clients;
 $Client->id =$Client_id+1;
 $Client->username = $nom_commercial;
 $Client->password = $password;
 $Client->email = $email;
 $Client->type = "livreur";
 $Client->created_at = now();
 $Client->updated_at = now();
 $Client->save();

     return view('./FrontEnd/ADMIN/admin',compact(
          'users',
          'colis'
     ));
}
}


function editer_livreur($id,$id_colis){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     return view('./FrontEnd/DELIVER/editer',compact(
          'users',
          'id_colis'

     ));

}

function changer_etat_livreur( $id,$id_colis){

     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

     $colis = DB::table('colis')
     ->where('id',$id_colis)
     ->get();

     return view('./FrontEnd/DELIVER/changer_status',compact(
          'users',
          'id_colis',
          'colis'
     ));
}

function handle_changer_etat_livreur(Request $request ){
     $id = $request->input('id');
     $id_colis = $request->input('id_colis');
     $etat = $request->input('etat');

     
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

     $Colis = DB::table('colis')
     ->where('id',$id_colis )
     ->update([
          'etat' => $etat
             ]);

             $transactions = DB::table('transactons')
             ->where('id_clients',$id)
             ->get();

             // rassembler les transtions du client dans seul table c.a.d les id du colis assignés
             $tab = array(
             );
             foreach ($transactions as $key => $value) {
                  array_push($tab,$value->id_colis);
             }
             
              // recuperer les colis en fonctions des transactions
              

              $colis = DB::table('colis')
              ->whereIn('id', $tab)
              ->get();


             return view('./FrontEnd/DELIVER/deliver',compact(
                  'users',
                  'colis',
                  'transactions'
             ));
}





//PROFILE
function user_detail($id){
          $users = DB::table('clients')
          ->where('id',$id)
          ->get();
          return view('./FrontEnd/PROFILE/user_detail',compact(
               'users'
          ));
}

function change_password($id){
     $message=" ";
     $statut=" ";
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     return view('./FrontEnd/PROFILE/change_password',compact(
          'users',
          'message',
          'statut'
     ));
}


function replace_password(Request $request){
     $id = $request->input('id');
     $new_password = $request->input('new_password');
     $confirm_password = $request->input('confirm_password');

     if($confirm_password != $new_password){
          $message="Les champs doivent etre les memes";
           $statut="different";
          $users = DB::table('clients')
          ->where('id',$id)
          ->get();
          return view('./FrontEnd/PROFILE/change_password',compact(
               'users',
               'message',
               'statut'
          ));
     }
     else{
          if(empty($new_password) || empty($confirm_password)){
               $message="Veuillez remplir tous les champs";
               $statut="vide";
              $users = DB::table('clients')
              ->where('id',$id)
              ->get();
              return view('./FrontEnd/PROFILE/change_password',compact(
                   'users',
                   'message',
                   'statut'
              ));
          }else{
               $users = DB::table('clients')
               ->where('id',$id)
               ->get();

               Clients::where('id', $users[0]->id)
               ->update(['password' => $new_password]);
              
               $colis = DB::table('Colis')
               ->where('id_clients',$users[0]->id)
               ->where('status','ramassage')
               ->get();
     
               $nbre_livraison= DB::table('Colis')
               ->where('id_clients',$id)
               ->where('status','livraison')
               ->count();
              
               $nbre_ramassage= DB::table('Colis')
               ->where('id_clients',$id)
               ->where('status','ramassage')
               ->count();

               switch($users[0]->type){
                    case "client" :{
                         $message=" ";
                         $status=" ";
                         return view('./FrontEnd/CLIENT/ramassage',compact(
                              'users',
                              'colis',
                              'nbre_ramassage',
                              'nbre_livraison',
                              'message',
                              'status'
                         ));
                         break;
                    }
     
                    case "admin" :{
                         $message=" ";
                         $status=" ";
                         return view('./FrontEnd/ADMIN/admin',compact(
                              'users',
                              'colis',
                              'status'
                         ));
                         break;
                    }
     
                    case "livreur" :{
                         // les colis qui sont assignés au livreur dans la table transaction
                        $transactions = DB::table('transactons')
                        ->where('id_clients',$users[0]->id)
                        ->get();
     
                        // rassembler les transtions du client dans seul table c.a.d les id du colis assignés
                        $tab = array(
                        );
                        foreach ($transactions as $key => $value) {
                             array_push($tab,$value->id_colis);
                        }
                        
                         // recuperer les colis en fonctions des transactions
                         
     
                         $colis = DB::table('colis')
                         ->whereIn('id_clients', $tab)
                         ->get();
     
     
                        return view('./FrontEnd/DELIVER/deliver',compact(
                             'users',
                             'colis',
                             'transactions'
                        ));
                        break;
                    }
     
          }
          }
         
}
}

function delete_count($id){
     $message="Compte supprimé ";
     $status="delete";
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
      DB::table('clients')
     ->where('id',$users[0]->id)
     ->delete();
     return view('welcome',compact('message','status'));
}

function user_detail_switch($id){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
    
     $status=" ";
     $message=" ";

     switch($users[0]->type){
          case "client" :{
               $colis = DB::table('colis')
               ->where('id_clients',$users[0]->id)
               ->get();
          
               $nbre_livraison= DB::table('Colis')
               ->where('id_clients',$id)
               ->where('status','livraison')
               ->count();
              
               $nbre_ramassage= DB::table('Colis')
               ->where('id_clients',$id)
               ->where('status','ramassage')
               ->count();

               return view('./FrontEnd/CLIENT/ramassage',compact(
                    'users',
                    'colis',
                    'nbre_ramassage',
                    'nbre_livraison',
                    'message',
                    'status'
               ));
               break;
          }

          case "admin" :{
                $colis = DB::table('Colis')
                 ->where('etat','ramassage')
                 ->orWhere('etat', 'livraison')
                 ->get();

               return view('./FrontEnd/ADMIN/admin',compact(
                    'users',
                    'colis'
               ));
               break;
          }

          case "livreur" :{
               // les colis qui sont assignés au livreur dans la table transaction
              $transactions = DB::table('transactons')
              ->where('id_clients',$users[0]->id)
              ->get();

              // rassembler les transtions du client dans seul table c.a.d les id du colis assignés
              $tab = array(
              );
              foreach ($transactions as $key => $value) {
                   array_push($tab,$value->id_colis);
              }
              
               // recuperer les colis en fonctions des transactions
               

               $colis = DB::table('colis')
               ->whereIn('id', $tab)
               ->get();


              return view('./FrontEnd/DELIVER/deliver',compact(
                   'users',
                   'colis',
                   'transactions'
              ));
              break;
          }

}
}

function editer($id,$id_colis){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     return view('./FrontEnd/PROFILE/editer',compact(
          'users',
          'id_colis'

     ));

}

function update($id,$id_colis){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

     $colis = DB::table('colis')
     ->where('id',$id_colis)
     ->get();

     return view('./FrontEnd/PROFILE/update',compact(
          'users',
          'colis',
          'id_colis'

     ));

}

function delete($id,$id_colis){
     DB::table('colis')->where('id',$id_colis)->delete();

     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     $colis = DB::table('Colis')
     ->where('status','ramassage')
     ->orWhere('status', 'livraison')
     ->get();

 return view('./FrontEnd/ADMIN/admin',compact(
      'users',
      'colis'
 ));
}

function choose_livreur($id,$id_colis){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

     $livreur = DB::table('clients')
     ->where('type','livreur')
     ->get();

     return view('./FrontEnd/PROFILE/choose_livreur',compact(
          'users',
          'id_colis',
          'livreur'

     ));

}

function handle_choose_livreur(Request $request){
     $id = $request->input('id');
     $id_colis = $request->input('id_colis');
     $livreur = $request->get('livreur');
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     if(empty($livreur)){
          $colis = DB::table('Colis')
          ->where('status','ramassage')
          ->orWhere('status', 'livraison')
          ->get();

          return view('./FrontEnd/ADMIN/admin',compact(
               'users',
               'colis'
          ));
     }else{
     DB::table('transactons')->where('id_colis',$id_colis)->delete();  

     $transactions_id = DB::table('transactons')
     ->select('id')
      ->max('id');

     $transactions = new Transactons;
     $transactions->id =$transactions_id+1;
     $transactions->id_clients =$livreur;
     $transactions->id_colis =$id_colis;
     $transactions->created_at = now();
     $transactions->updated_at = now();
     $transactions->save();

     // Changer l'etat du colis
    /* $Colis = DB::table('colis')
     ->where('id',$id_colis )
     ->update([
          'etat' => 'Coli pris en charge'
             ]);*/


              $colis = DB::table('Colis')
              ->where('etat','ramassage')
              ->orWhere('etat', 'livraison')
              ->get();

              return view('./FrontEnd/ADMIN/admin',compact(
                   'users',
                   'colis'
              ));
          }

}

function handle_update(Request $request){
     $id = $request->input('id');
     $id_colis = $request->input('id_colis');

     $reference = $request->input('reference');
     $destinataire = $request->input('destinataire');
     $telephone = $request->input('telephone');
     $produit = $request->input('produit');
     $note = $request->input('note');
     $ville = $request->input('ville');
     $prix = $request->input('prix');
     $options_rembourser = $request->input('options_rembourser');
     $options_ouvrir = $request->input('options_ouvrir');
     $options_changer = $request->input('options_changer');
    
     $Colis = DB::table('colis')
     ->where('id',$id_colis )
     ->update([
          'reference' => $reference,
          'destinateur' => $destinataire,
          'telephone' => $telephone,
          'commentaire' => $note,
          'produit' => $produit,
          'ville' => $ville,
          'prix' => $prix,
          'options' => $options_rembourser.'/'.$options_ouvrir.'/'. $options_changer 

             ]);


 $users = DB::table('clients')
     ->where('id',$id)
     ->get();

 $colis = DB::table('Colis')
 ->where('status','ramassage')
 ->orWhere('status', 'livraison')
 ->get();

 return view('./FrontEnd/ADMIN/admin',compact(
      'users',
      'colis'
 ));
}

function changer_etat( $id,$id_colis){

     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

     $colis = DB::table('colis')
     ->where('id',$id_colis)
     ->get();

     return view('./FrontEnd/PROFILE/changer_etat',compact(
          'users',
          'id_colis',
          'colis'
     ));
}

function handle_changer_etat(Request $request ){
     $id = $request->input('id');
     $id_colis = $request->input('id_colis');
     $etat = $request->input('etat');

     $Colis = DB::table('colis')
     ->where('id',$id_colis )
     ->update([
          'etat' => $etat
             ]);


     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

 $colis = DB::table('Colis')
 ->where('etat','ramassage')
 ->orWhere('etat','livraison')
 ->get();

 return view('./FrontEnd/ADMIN/admin',compact(
      'users',
      'colis'
 ));
}


function commentaire_livreur( $id,$id_colis){

     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

     $colis = DB::table('colis')
     ->where('id',$id_colis)
     ->get();

     return view('./FrontEnd/DELIVER/commentaire',compact(
          'users',
          'id_colis',
          'colis'
     ));
}

function handle_commentaire_livreur(Request $request ){
     $id = $request->input('id');
     $id_colis = $request->input('id_colis');
     $note = $request->input('note');
     $Colis = DB::table('colis')
     ->where('id',$id_colis )
     ->update([
          'commentaire' => $note
             ]);


     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

 $transactions = DB::table('transactons')
 ->where('id_clients',$id)
 ->get();

 // rassembler les transtions du client dans seul table c.a.d les id du colis assignés
 $tab = array(
 );
 foreach ($transactions as $key => $value) {
      array_push($tab,$value->id_colis);
 }
 
  // recuperer les colis en fonctions des transactions
  

  $colis = DB::table('colis')
  ->whereIn('id', $tab)
  ->get();


 return view('./FrontEnd/DELIVER/deliver',compact(
      'users',
      'colis',
      'transactions'
 ));
}

function editer_client($id,$id_colis){
     $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     return view('./FrontEnd/CLIENT/editer',compact(
          'users',
          'id_colis'

     ));

}

function changer_destinataire( $id,$id_colis){

     $users = DB::table('clients')
     ->where('id',$id)
     ->get();

     $colis = DB::table('colis')
     ->where('id',$id_colis)
     ->get();

     return view('./FrontEnd/CLIENT/changer_destinataire',compact(
          'users',
          'id_colis',
          'colis'
     ));
}


function handle_changer_destinataire_client(Request $request ){
     $id = $request->input('id');
     $id_colis = $request->input('id_colis');
     $destinataire = $request->input('destinataire');

             $users = DB::table('clients')
             ->where('id',$id)
             ->get();

             $colis = DB::table('colis')
               ->where('id_clients',$id)
               ->where('status','ramassage')
               ->get();

             $nbre_livraison= DB::table('Colis')
             ->where('id_clients',$id)
             ->where('status','livraison')
             ->count();
            
             $nbre_ramassage= DB::table('Colis')
             ->where('id_clients',$id)
             ->where('status','ramassage')
             ->count();
             $status=" ";
             $message=" ";

          if(empty($destinataire)){
               return view('./FrontEnd/CLIENT/ramassage',compact(
                    'colis',
                    'users',
                    'nbre_livraison',
                    'nbre_ramassage',
                    'message',
                    'status'
               ));
          }else{
               $Colis = DB::table('colis')
               ->where('id',$id_colis )
               ->update([
                    'destinateur' => $destinataire
                       ]);

                  return view('./FrontEnd/CLIENT/ramassage',compact(
                       'colis',
                       'users',
                       'nbre_livraison',
                       'nbre_ramassage',
                       'message',
                       'status'
                  ));
               }
}

//REchercher
function rechercher(Request $request){
     $id = $request->input('id');
     $type = $request->input('type');
     $rechercher = $request->input('rechercher');
     switch($type){
          case 'ramassage' :{
               $colis = DB::table('colis')
               ->where('id_clients',$id)
               ->where('reference',$rechercher)
               ->get();
               $users = DB::table('clients')
               ->where('id',$id)
               ->get();
          
               $nbre_livraison= DB::table('Colis')
               ->where('id_clients',$users[0]->id)
               ->where('status','livraison')
               ->count();
          
               $nbre_ramassage= DB::table('Colis')
               ->where('id_clients',$users[0]->id)
               ->where('status','ramassage')
               ->count();
               $status=" ";
               $message=" ";
          
               return view('./FrontEnd/CLIENT/liste_ramassage',compact(
                    'users',
                    'colis',
                    'nbre_ramassage',
                    'nbre_livraison',
                    'message',
                    'status'
               ));
               break;
          }

          case 'livraison' :{
               $colis = DB::table('colis')
               ->where('id_clients',$id)
               ->where('reference',$rechercher)
               ->get();
               $users = DB::table('clients')
               ->where('id',$id)
               ->get();
          
               $nbre_livraison= DB::table('Colis')
               ->where('id_clients',$users[0]->id)
               ->where('status','livraison')
               ->count();
          
               $nbre_ramassage= DB::table('Colis')
               ->where('id_clients',$users[0]->id)
               ->where('status','ramassage')
               ->count();
               $status=" ";
               $message=" ";
               
               return view('./FrontEnd/CLIENT/liste_ramassage',compact(
                    'users',
                    'colis',
                    'nbre_ramassage',
                    'nbre_livraison',
                    'message',
                    'status'
               ));
               break;
          }

          case "livreur" :{
               // les colis qui sont assignés au livreur dans la table transaction
              $transactions = DB::table('transactons')
              ->where('id_clients',$id)
              ->get();

              // rassembler les transtions du client dans seul table c.a.d les id du colis assignés
              $tab = array(
              );
              foreach ($transactions as $key => $value) {
                   array_push($tab,$value->id_colis);
              }
              
               // recuperer les colis en fonctions des transactions
               
               $users = DB::table('clients')
               ->where('id',$id)
               ->get();
               $colis = DB::table('colis')
               ->whereIn('id', $tab)
               ->where('reference', $rechercher)
               ->get();


              return view('./FrontEnd/DELIVER/deliver',compact(
                   'users',
                   'colis',
                   'transactions'
              ));
              break;
          }
             
          case "nouveau" :{
               $users = DB::table('clients')
               ->where('id',$id)
               ->get();
          

              $colis = DB::table('Colis')
              ->where('reference',$rechercher)
              ->where('status','livraison')
              ->orwhere('status','ramassage')
              ->get();

              return view('./FrontEnd/ADMIN/admin',compact(
                   'users',
                   'colis'
              ));
              break;
          }

          case "traitement" :{

               $users = DB::table('clients')
     ->where('id',$id)
     ->get();
     $colis = DB::table('Colis')
     ->where('status','<>','ramassage')
     ->where('status','<>','livraison')
     ->where('reference',$rechercher)
     ->get();
        return view('./FrontEnd/ADMIN/colis_en_traitement',compact(
             'users',
             'colis'
        ));
           }

           case "liste_livreur" : {
               $users_list= DB::table('clients')
               ->where('type','livreur')
               ->where('username',$rechercher)
               ->get();
               $users = DB::table('clients')
               ->where('id',$id)
               ->get();
               //dd($users_list);
               return view('./FrontEnd/ADMIN/liste_livreur',compact(
                    'users',
                    'users_list'
               ));
                break;
         }
     case "liste_client" : {
          $users = DB::table('clients')
          ->where('id',$id)
          ->get();
          $users_list= DB::table('clients')
          ->where('type','client')
          ->where('username',$rechercher)
          ->get();
          return view('./FrontEnd/ADMIN/liste_client',compact(
               'users',
               'users_list'
          ));
          break;
}
     }

}

function deliver($id) {

$transactions = DB::table('transactons')
->where('id_clients',$id)
->get();

// rassembler les transtions du client dans seul table c.a.d les id du colis assignés
$tab = array(
);
foreach ($transactions as $key => $value) {
     array_push($tab,$value->id_colis);
}

 // recuperer les colis en fonctions des transactions
 

 $colis = DB::table('colis')
 ->whereIn('id', $tab)
 ->get();

$users = DB::table('clients')
     ->where('id',$id)
     ->get();
return view('./FrontEnd/DELIVER/deliver',compact(
     'users',
     'colis',
     'transactions'
));

}

}
