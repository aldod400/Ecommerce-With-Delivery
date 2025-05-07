<?php

namespace App\Services\Implementations;

use App\Helpers\Helpers;
use App\Repository\Contracts\AuthRepositoryInterface;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(string $identifier, string $password, ?string $fcmToken)
    {
        $user = $this->authRepository->findByIdentifier($identifier);
        if (!$user)
            throw new AuthenticationException(__('message.Invalid Email or Phone'));


        if (!Hash::check($password, $user->password))
            throw new AuthenticationException(__('message.Invalid Password'));

        $token = auth('api')->login($user);

        if ($fcmToken)
            $this->updateFcmToken($fcmToken);

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function register(array $data)
    {
        if ($data['image'])
            $data['image'] = Helpers::addImage($data['image'], 'users');

        $data['image'] = $data['image'] ?? 'images/default.png';

        $data['password'] = Hash::make($data['password']);

        $user = $this->authRepository->register($data);

        $token = auth('api')->login($user);

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function profile()
    {
        return $this->authRepository->getUser();
    }

    public function updateProfile(array $data)
    {
        $user = auth('api')->user();
        if ($data['image']) {
            if (File::exists($user->image)) {
                File::delete($user->image);
            }
            $data['image'] = Helpers::addImage($data['image'], 'users');
        }

        $data['image'] = $data['image'] ?? $user->image;

        $data['password'] = $data['password'] ?? $user->password;
        $data['email'] = $data['email'] ?? $user->email;
        $data['phone'] = $data['phone'] ?? $user->phone;

        if ($data['password'])
            $data['password'] = Hash::make($data['password']);

        if ($data['fcm_token'])
            $this->updateFcmToken($data['fcm_token']);

        return $this->authRepository->updateUser($data);
    }

    public function updateFcmToken(string $fcmToken)
    {
        return $this->authRepository->updateFcmToken($fcmToken);
    }
}
