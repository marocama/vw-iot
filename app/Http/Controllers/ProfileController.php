<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\PasswordValidationFormRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // *******************************************
    // ** Exibe informações sobre o usuário logado
    public function index()
    {
        return view('profile');
    }

    // ******************************************************
    // ** Recebe um POST para atualizar o telefone do usuário
    public function upTell(Request $request)
    {
        if (strlen($request->phone) >= 14 && strlen($request->phone <= 15))
        {
            auth()->user()->phone = str_replace(['(', ')', '-', ' '], '', $request->phone);
            auth()->user()->save();

            return redirect()
                        ->route('profile')
                        ->with('success', 'Telefone atualizado com sucesso.');
        }

        return redirect()
                        ->route('profile')
                        ->with('error', 'Telefone inválido, tente novamente.');
    }

    // ***************************************************
    // ** Recebe um POST para atualizar a senha do usuário
    public function upPass(PasswordValidationFormRequest $request, User $user)
    {
        $att = $user->newPass($request->passNew, $request->passNewConf);

        if($att['success']) 
            return redirect()
                        ->route('profile')
                        ->with('success', $att['message']);

        if(!$att['success']) 
            return redirect()
                        ->route('profile')
                        ->with('error', $att['message']);
    }

    // **************************************************
    // ** Recebe um POST para atualizar a logo do usuário
    public function logoUpdate(Request $request)
    {
        if (auth()->user()->user_type == "Operador") 
            return redirect()
                        ->route('profile')
                        ->with('error', 'Sua conta não possui autorização para essa função.');

        if (auth()->user()->permit_customize)
        {
            if ($request->hasFile('logo') && $request->file('logo')->isValid())
            {
                if ($request->logo->extension() == "png" || $request->logo->extension() == "jpeg" || $request->logo->extension() == "jpg")
                {

                    $nameFile = date('YmdHis').kebab_case(auth()->user()->name).".".$request->logo->extension();
                    $update = $request->logo->storeAs('logos', $nameFile);   

                    if (!$update)
                        return redirect()
                                ->route('profile')
                                ->with('error', 'Erro no upload, tente novamente.');

                    Storage::delete("logos/".auth()->user()->fileName);

                    auth()->user()->operators()->update(['fileName' => $nameFile]);
                    auth()->user()->fileName = $nameFile;
                    auth()->user()->save();

                    return redirect()
                                ->route('profile')
                                ->with('success', 'Logo alterada com sucesso.');
                }

                return redirect()
                            ->route('profile')
                            ->with('error', 'Extensão de imagem não suportada, tente novamente.');
            }
            return redirect()
                        ->route('profile')
                        ->with('error', 'Imagem inválida, tente novamente');
        }    
        return redirect()
                    ->route('profile')
                    ->with('error', 'Sua conta não possui autorização para essa função.');
    }

    // ************************************************
    // ** Recebe um POST para deletar a logo do usuário
    public function logoDelete()
    {   
        if (auth()->user()->user_type == "Operador") 
            return redirect()
                        ->route('profile')
                        ->with('error', 'Sua conta não possui autorização para essa função.');

        $del = Storage::delete("logos/".auth()->user()->fileName);

        if ($del)
        {
            auth()->user()->operators()->update(['fileName' => null]);
            auth()->user()->fileName = null;
            auth()->user()->save();

            return redirect()
                    ->route('profile')
                    ->with('success', 'Imagem deletada com sucesso.');
        }
    
        return redirect()
                    ->route('profile')
                    ->with('error', 'Ocorreu um erro, tente novamente.');
    }
    
    // *************************************************
    // ** Recebe um POST para atualizar a URL do usuário
    public function linkUpdate(Request $request)
    {
        if (auth()->user()->user_type == "Operador") 
            return redirect()
                        ->route('profile')
                        ->with('error', 'Sua conta não possui autorização para essa função.');

        if (auth()->user()->permit_customize)
        {
            if (ctype_alnum($request->link))
            {
                if (strlen($request->link) >= 5)
                {
                    if (User::where('linkName', strtolower($request->link))->count() != 0)
                        return redirect()
                                    ->route('profile')
                                    ->with('error', 'Link indisponível, tente novamente.');

                    auth()->user()->linkName = strtolower($request->link);
                    auth()->user()->save();

                    return redirect()
                            ->route('profile')
                            ->with('success', 'Link alterado e disponível, tente login através de https://vwiot.io/'.strtolower($request->link));
                }

                return redirect()
                            ->route('profile')
                            ->with('error', 'O link deve conter pelo menos 5 caracteres.');
            }
            return redirect()
                        ->route('profile')
                        ->with('error', 'O link deve conter apenas letras e números.');
        }
        return redirect()
                    ->route('profile')
                    ->with('error', 'Sua conta não possui autorização para essa função.');
    }
}
