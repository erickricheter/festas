<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:5',
    ]);

    $existingUser = User::where('email', $request->email)->first();

    if ($existingUser) {
      return response()->json(['error' => 'O e-mail informado já está sendo utilizado.'], 409);
    }

    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    $token = $user->createToken('myapptoken')->plainTextToken;

    $response = [
      'user' => $user,
      'token' => $token,
      'message' => 'Usuário registrado e logado com sucesso',
    ];

    return response($response, 201);
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
      return response()->json(['error' => 'Usuário não encontrado.'], 404);
    }

    if (!Hash::check($request->password, $user->password)) {
      return response()->json(['error' => 'E-mail ou senha incorretos!'], 401);
    }

    $token = $user->createToken('myapptoken')->plainTextToken;

    $response = [
      'user' => $user,
      'token' => $token,
      'message' => 'Usuário logado com sucesso',
    ];

    return response()->json($response);
  }

  public function logout(Request $request)
  {
    $user = $request->user();

    if (!$user) {
      return response()->json(['error' => 'Usuário não autenticado.'], 401);
    }

    $user->currentAccessToken()->delete();

    return response()->json(['message' => 'Usuário deslogado com sucesso'], 200);
  }

  public function updateUser(Request $request, User $user)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'sometimes|nullable|email|unique:users,email,' . $user->id,
      'password' => 'required|min:5',
    ]);

    $user->name = $request->name;
    if ($request->has('email')) {
      $user->email = $request->email;
    }
    $user->password = Hash::make($request->password);
    $user->save();

    return response()->json(['message' => 'Usuário atualizado com sucesso'], 200);
  }
  public function listUsers()
  {
    $users = User::all();

    return response()->json($users, 200);
  }

  public function getUser($id)
  {
    try {
      $user = User::findOrFail($id);
      return response()->json($user, 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
      return response()->json(['message' => 'Usuário não encontrado'], 404);
    }
  }

  public function deleteUser($id)
  {
    $authenticatedUser = auth()->user();

    if (!$authenticatedUser) {
      return response()->json(['error' => 'Usuário não encontrado.'], 404);
    }

    if ($authenticatedUser->id === $id) {
      return response()->json(['error' => 'Você não pode excluir o seu próprio usuário.'], 403);
    }

    try {
      $userToDelete = User::findOrFail($id);

      // Verificar se o usuário autenticado tem permissão para excluir outros usuários
      if ($authenticatedUser->id === $userToDelete->id) {
        return response()->json(['error' => 'Você não tem permissão para excluir este usuário.'], 403);
      }

      $userToDelete->delete();

      return response()->json(['message' => 'Usuário deletado com sucesso'], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
      return response()->json(['error' => 'Usuário não encontrado.'], 404);
    }
  }
}
