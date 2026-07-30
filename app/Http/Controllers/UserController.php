<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use App\Http\Resources\PaginateResource;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Helpers\ResponseHelper;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        try {
            $users = $this->userRepository->getAll($request->search, $request->limit, true);
            //Menggunakan collection artinya data banyak
            return ResponseHelper::jsonResponse(true, 'Data User Berhasil diambil', UserResource::collection($users), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    public function getAllPaginated(Request $request)
    {
        $request = $request->validate([
            'search' => 'nullable|string',
            'row_per_page' => 'required|integer'
        ]);
        try {
            $users = $this->userRepository->getAllPaginated($request['search'] ?? null, $request['row_per_page']);
            return ResponseHelper::jsonResponse(true, 'Data User Berhasil diambil', PaginateResource::make($users, UserResource::class), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $request = $request->validated();
        try {
            $user = $this->userRepository->create($request);
            return ResponseHelper::jsonResponse(true, 'Data User Berhasil ditambahkan', new UserResource($user), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $users = $this->userRepository->getById($id);
            if (!$users) {
                return ResponseHelper::jsonResponse(false, 'Data User Tidak ditemukan', null, 404);
            }
            return ResponseHelper::jsonResponse(true, 'Data User Berhasil diambil', new UserResource($users), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /** 
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {

        $request = $request->validated();
        try {
            $users = $this->userRepository->getById($id);
            if (!$users) {
                return ResponseHelper::jsonResponse(false, 'Data User Tidak ditemukan', null, 404);
            }
            $user = $this->userRepository->update($id, $request);
            return ResponseHelper::jsonResponse(true, 'Data User Berhasil diperbarui', new UserResource($user), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $users = $this->userRepository->getById($id);
            if (!$users) {
                return ResponseHelper::jsonResponse(false, 'Data User Tidak ditemukan', null, 404);
            }
            $user = $this->userRepository->delete($id);
            return ResponseHelper::jsonResponse(true, 'Data User Berhasil dihapus', new UserResource($user), 200);
        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
}
