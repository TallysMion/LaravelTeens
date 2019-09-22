<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\leader_teen;
use App\user_activity;
use App\activity;
use Hash;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $user = auth()->user();
        if($user->type == 'Admin'){
          $teens = User::where('type', 'teen')->get();
        }else{
          $teens = User::join('leader_teens', 'leader_teens.teen', 'users.id')
                      ->where('leader_teens.leader', $user->id)->select('users.*')->get();
        }

        foreach ($teens as $teen) {
          $teen['score'] = $teen->getScore();
        }

        $teens = $teens->sortByDesc('score');
        return view('home', compact('teens'));
    }

    public function activities(){
      $activities = activity::get();
      return view('activity', compact('activities'));
    }

    public function activitiesAdd(){
      $data = $_POST;

      if($data['value'] <= 0) return redirect()->route('activity')->withErrors('Valor Invalido')->withInput();
      if(isset($data['id'])){
        if(count(activity::where('name', $data['name'])->where('id', '<>', $data['id'])->get()))
          return redirect()->route('activity')->withErrors('Existe outra atividade já cadastrada com esse nome');
        $activity = activity::where('id', $data['id'])->get()->first();
        $activity->name = $data['name'];
        $activity->value = $data['value'];
        $activity->save();
      }else{
        if(count(activity::where('name', $data['name'])->get()))
          return redirect()->route('activity')->withErrors('Nome já cadastrado')->withInput();
        activity::create([
          'name' => $data['name'],
          'type' => $data['type'],
          'value' => $data['value']
        ]);
      }

      return redirect()->route('activity');
    }

    public function leaders(){
      $leaders = User::where('type', 'leader')->get();
      return view('Leader', compact('leaders'));
    }

    public function leadersAdd(){
      $data = $_POST;
      if($data['password'] < 6)
        return redirect()->route('leader')->withErrors('Senha muito Curta');
      if(isset($data['id'])){
        if(count(User::where('id', '<>', $data['id'])->where('email', $data['email'])->get()))
          return redirect()->route('leader')->withErrors('Não foi possivel Atribuir email');
        $leader = User::where('id', $data['id'])->get()->first();
        $leader->name = $data['name'];
        $leader->password = Hash::make($data['password']);
        $leader->save();
      }else{
        if(count(User::where('email', $data['email'])->get()))
          return redirect()->route('leader')->withErrors('Não foi possivel Atribuir email');
        User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'password' => Hash::make($data['password']),
          'type' => 'leader',
        ]);
      }
      return redirect()->route('leader');
    }

    public function teenAdd(){
      $data = $_POST;
      if($data['password'] < 6)
        return redirect()->route('home')->withErrors('Senha muito Curta');
      if(isset($data['id'])){
        if(count(User::where('id', '<>', $data['id'])->where('email', $data['email'])->get()))
          return redirect()->route('home')->withErrors('Não foi possivel Atribuir email');
        $teen = User::where('id', $data['id'])->get()->first();
        $teen->name = $data['name'];
        $teen->password = Hash::make($data['password']);
        $teen->save();
      }else{
        if(count(User::where('email', $data['email'])->get()))
          return redirect()->route('home')->withErrors('Não foi possivel Atribuir email');
        $user = User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'password' => Hash::make($data['password']),
          'type' => 'teen',
        ]);
        leader_teen::create([
          'leader' => Auth::user()->id,
          'teen' => $user->id
        ]);
      }
      return redirect()->route('home');
    }

    public function calling(){
      $user = auth()->user();

      $teens = User::join('leader_teens', 'leader_teens.teen', 'users.id')
                  ->where('leader_teens.leader', $user->id)->select('users.*')->get();

      $activities = activity::get();

      return view('calling', compact('teens', 'activities'));
    }

    public function callingAdd(){
      $data = $_POST;
      $teensId = $data['teen'];
      $activities = activity::get();
      foreach ($teensId as $key => $teenId) {
        foreach ($activities as $activity) {
          $strKey = str_replace(" ", "_", $activity->name);
          user_activity::create([
            'value'=> $activity->type=="number"?$data[$strKey][$key]:isset($data[$strKey][$key])?1:0,
            'user' => $teenId,
            'activity' => $activity->id,
          ]);
        }
      }
      return redirect()->route('home');
    }


}
