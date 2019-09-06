<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\User;
use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Transmitter;
use Illuminate\Support\Facades\Auth;
use App\Models\Interaction;
use App\Models\Readout;

class AdminController extends Controller
{

    // *********************************
    // ***** Etapa de verificação ******
    // *****    Administrador     ******
    // *********************************

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            if ($this->user->user_type != "Admin")
                return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui autorização para acessar essa página.');

            return $next($request);
        });
    }

    // *********************************
    // ********* Página Inial **********
    // ******************************************************************************************************************

    // *****************************************************
    // ** Recebe um POST e retorna valores da pesquisa geral
    public function query(Request $request)
    {
        $users = User::where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('phone', 'like', '%'.$request->search.'%')
                        ->orWhere('document', 'like', '%'.$request->search.'%')
                        ->orWhere('user_token', 'like', '%'.$request->search.'%')->limit(30)->get();
        
        $transmitters = Transmitter::where('name', 'like', '%'.$request->search.'%')
                                        ->orWhere('number_serial', 'like', '%'.$request->search.'%')->limit(30)->get();
        
        return view('admin.index', compact('users', 'transmitters'));
    }

    // *********************************
    // *********** Usuário *************
    // ******************************************************************************************************************

    // *****************************************
    // ** Recebe um POST para deletar um usuário
    public function userDel(Request $request)
    {
        $user = User::find($request->identify1);

        if(!$user)
            return redirect()
                    ->route('home')
                    ->with('error', 'Ocorreu um erro, tente novamente.');

        $check = Transmitter::where('user_id', $user->id)->count();
        
        if ($check > 0)
            return redirect()
                    ->route('home')
                    ->with('error', 'Este usuário possui transmissores cadastrados, impossibilitando sua exclusão.');
   
        Alert::where('user_id', $user->id)->delete();
        Contact::where('user_id', $user->id)->delete();

        $user->delete();
            return redirect()
                    ->route('home')
                    ->with('success', 'Usuário deletado com sucesso.');
        
        return redirect()
                    ->route('home')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // *****************************************************************
    // ** Recebe um POST para visualizar todas informações de um usuário
    public function userView(Request $request)
    {
        $user = User::find($request->identify);
        $master = collect();

        if (!$user)
            return redirect()
                    ->route('home')
                    ->with('error', 'Ocorreu um erro, tente novamente.');

        if ($user->user_id != NULL)
            $master = User::find($user->user_id);
        
        return view('admin.user', compact('user', 'master'));
        
        return redirect()
                    ->route('home')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // **********************************************************************
    // ** Recebe um POST com as alterações feitas no cadastrado de um usuário
    public function userEdit(Request $request)
    {
        $user = User::find($request->identify);

        if ($user)
        {
            $user->name             = $request->name;
            $user->document         = str_replace(['/', '-', '.'], '', $request->document);
            $user->cep              = $request->cep;
            $user->phone            = str_replace(['(', ')', '-', ' '], '', $request->phone);
            $user->birth            = $request->birth;
            $user->email            = $request->email;
            $user->expiration       = $request->expiration;
            $user->permit_customize = $request->custom;

            $user->save();

            return redirect()
                    ->route('home')
                    ->with('success', 'Usuário alterado com sucesso.');
        }
        return redirect()
                    ->route('home')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // *********************************
    // ********* Transmissor ***********
    // ******************************************************************************************************************

    // *********************************************
    // ** Recebe um POST para deletar um transmissor
    public function transmitterDel(Request $request)
    {
        $transmitter = Transmitter::find($request->identify2);
        
        if(!$transmitter)
            return redirect()
                    ->route('home')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
        
        $transmitter->readout()->delete();

        $transmitter->delete();
            return redirect()
                    ->route('home')
                    ->with('success', 'Transmissor deletado com sucesso.');
        
        return redirect()
                    ->route('home')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // *********************************************************************
    // ** Recebe um POST para visualizar todas informações de um transmissor
    public function tranView(Request $request)
    {
        $tran = Transmitter::find($request->identify);
        $user = collect();
        $interface = collect();

        if (!$tran)
            return redirect()
                    ->route('home')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
        
        if ($tran->user_id != NULL)
            $user = User::find($tran->user_id);

        if ($tran->interaction_id != NULL)
            $interface = Interaction::find($tran->interaction_id);

        return view('admin.transmitter', compact('tran', 'user', 'interface'));
        
        return redirect()
                    ->route('home')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // **************************************************************************
    // ** Recebe um POST com as alterações feitas no cadastrado de um transmissor
    public function tranEdit(Request $request)
    {
        $tran = Transmitter::find($request->identify);

        if ($tran)
        {
            $tran->name             = $request->name;
            $tran->number_serial    = $request->serial;
            $tran->location         = $request->location;
            $tran->status           = $request->status;

            $tran->save();

            return redirect()
                    ->route('home')
                    ->with('success', 'Transmissor alterado com sucesso.');
        }
        return redirect()
                    ->route('home')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // *************************************************
    // ** Exibe página para registro de novo transmissor
    public function tranNew()
    {
        return view('admin.register');
    }

    // ***************************************************
    // ** Recebe um POST para registro de novo transmissor
    public function tranSave(Request $request, Transmitter $transmitter)
    {
        if (strlen($request->serial) != 10)
            return redirect()
                        ->route('admin.tran.new')
                        ->with('error', 'Número Serial deve conter 10 caracteres.');

        $register = $transmitter->new($request->serial, $request->status);
        
        if ($register)
            return redirect()
                    ->route('home')
                    ->with('success', $register['message']);

        return redirect()
                    ->route('home')
                    ->with('error', $register['message']);
    }

    // *********************************
    // *********** Alertas *************
    // ******************************************************************************************************************

    // ***********************************************************************
    // ** Exibe formulário para criação de novo alerta e alertas já públicados
    public function alert()
    {
        $alerts = Alert::where('public', 1)->orderBy('period', 'desc')->get();
        return view('admin.alerts', compact('alerts'));
    }

    // ********************************************************
    // ** Recebe um POST para publicação de novo alerta público
    public function registerAlert(Request $request, Alert $alert)
    {
        $notify = $alert->registerAdmin($request->message, $request->symbol, $request->color, $request->period1.$request->period2);
        
        if ($notify)
            return redirect()
                    ->route('admin.alert')
                    ->with('success', 'Alerta publicado com sucesso.');

        return redirect()
                    ->route('admin.alert')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // ************************************************
    // ** Recebe um POST para deletar um alerta público
    public function deleteAlert(Request $request)
    {
        $alert = Alert::find($request->identify);
        
        if(!$alert)
            return redirect()
                    ->route('admin.alert')
                    ->with('error', 'Ocorreu um erro, tente novamente.nao achou');
    
        $alert->delete();
            return redirect()
                    ->route('admin.alert')
                    ->with('success', 'Alerta deletado com sucesso.');
        
        return redirect()
                    ->route('admin.alert')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // *********************************
    // ********* Vencimentos ***********
    // ******************************************************************************************************************

    // ********************************************************************
    // ** Exibe todos usuário com contas vencidas ou próximas do vencimento
    public function expirations()
    {
        $users = User::where('expiration', '<', date('Y-m-d H:i:s', strtotime('+1 week')))->orderBy('expiration', 'desc')->limit(50)->get();
        return view('admin.expirations', compact('users'));
    }

    // *********************************
    // *********** Suporte *************
    // ******************************************************************************************************************

    // ***********************************************************
    // ** Exibe todas as mensagens pendente de resposta do suporte
    public function suport()
    {
        $messages = Contact::with(['user'])->where('answered', false)->orderBy('updated_at', 'desc')->get();
        return view('admin.suport', compact('messages'));
    }

    public function answered(Request $request)
    {
        $message = Contact::find($request->identify);
        
        if($message)
        {
            $message->answered = true;
            $message->save();
            return redirect()->route('admin.suport');
        }

        return redirect()
                    ->route('admin.suport')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }   
    
    // *********************************
    // ********** Interfaces ***********
    // ******************************************************************************************************************

    // *************************************************************************
    // ** Exibe formulário para criação de nova interface e interfaces já ativas
    public function interaction()
    {
        $interactions = Interaction::get();
        return view('admin.interactions', compact('interactions'));
    }

    // ***************************************************
    // ** Recebe um POST para publicação de nova interface
    public function registerInteraction(Request $request, Interaction $interaction)
    {
        $notify = $interaction->registerInterface($request->code, $request->name, $request->description);
        
        if ($notify)
            return redirect()
                    ->route('admin.interaction')
                    ->with('success', 'Interface publicada com sucesso.');

        return redirect()
                    ->route('admin.interaction')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // ********** Dados Antigos ***********
    // ******************************************************************************************************************

    // **************************************
    // ** Exibe alguns dos dados mais antigos
    public function data()
    {
        $readouts = Readout::oldest()->limit(5)->get();
        $totalReadouts = Readout::count();
        $totalTransmitter = Transmitter::count();
        return view('admin.data', compact('readouts', 'totalReadouts', 'totalTransmitter'));
    }

    // *************************************************
    // ** Recebe um POST para deletar dados até uma data
    public function deleteData(Request $request)
    {
        $data = Readout::whereDate('created_at', '<=', $request->period)->get();
        
        if($data->count() == 0)
            return redirect()
                    ->route('admin.data')
                    ->with('error', 'Não há registros anteriores a data selecionada.');
    
        Readout::whereDate('created_at', '<=', $request->period)->delete();
            return redirect()
                    ->route('admin.data')
                    ->with('success', $data->count().' registro(s) deletado(s) com sucesso.');
        
        return redirect()
                    ->route('admin.data')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }
}
