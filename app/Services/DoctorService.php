<?php

namespace App\Services;

use App\Models\Doctor;
use App\Models\User;
use App\Repositories\DoctorRepository;
use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorService
{
    public function __construct(
        protected DoctorRepository $repository
    ) {}

    public function getAllDoctors()
    {
        return $this->repository->getAllPaginated();
    }

    public function filterDoctors(array $filters)
    {
        return $this->repository->filter($filters);
    }

    public function createDoctor(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Create User
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $user->assignRole(UserRoleEnum::DOCTOR->value);

            // 2. Create Doctor Profile
            $doctorData = [
                'user_id' => $user->id,
                'department_id' => $data['department_id'],
                'specialization' => $data['specialization'],
                'experience_years' => $data['experience_years'] ?? 0,
                'consultation_fee' => $data['consultation_fee'] ?? 0,
                'hospital_name' => $data['hospital_name'] ?? null,
                'bio' => $data['bio'] ?? null,
                'status' => $data['status'] ?? true,
                'is_featured' => $data['is_featured'] ?? false,
                'social_links' => $data['social_links'] ?? null,
            ];

            $doctor = $this->repository->create($doctorData);

            // 3. Handle Profile Image
            if (isset($data['profile_image'])) {
                $doctor->addMedia($data['profile_image'])->toMediaCollection('profile_image');
            }

            // 4. Handle Educations
            if (isset($data['educations']) && is_array($data['educations'])) {
                foreach ($data['educations'] as $edu) {
                    if (!empty($edu['degree'])) {
                        $doctor->educations()->create($edu);
                    }
                }
            }

            // 5. Handle Experiences
            if (isset($data['experiences']) && is_array($data['experiences'])) {
                foreach ($data['experiences'] as $exp) {
                    if (!empty($exp['designation'])) {
                        $doctor->experiences()->create($exp);
                    }
                }
            }

            return $doctor;
        });
    }

    public function updateDoctor(Doctor $doctor, array $data)
    {
        return DB::transaction(function () use ($doctor, $data) {
            // 1. Update User
            $doctor->user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            if (!empty($data['password'])) {
                $doctor->user->update(['password' => Hash::make($data['password'])]);
            }

            // 2. Update Doctor Profile
            $this->repository->update($doctor, $data);

            // 3. Handle Profile Image
            if (isset($data['profile_image'])) {
                $doctor->addMedia($data['profile_image'])->toMediaCollection('profile_image');
            }

            // 4. Handle Educations (Simple sync for now: delete and re-create or update existing)
            // For simplicity in this demo, let's just re-create if provided or handle specifically
            if (isset($data['educations']) && is_array($data['educations'])) {
                $doctor->educations()->delete();
                foreach ($data['educations'] as $edu) {
                    if (!empty($edu['degree'])) {
                        $doctor->educations()->create($edu);
                    }
                }
            }

            // 5. Handle Experiences
            if (isset($data['experiences']) && is_array($data['experiences'])) {
                $doctor->experiences()->delete();
                foreach ($data['experiences'] as $exp) {
                    if (!empty($exp['designation'])) {
                        $doctor->experiences()->create($exp);
                    }
                }
            }

            return $doctor;
        });
    }

    public function deleteDoctor(Doctor $doctor)
    {
        return DB::transaction(function () use ($doctor) {
            $user = $doctor->user;
            $doctor->delete();
            $user->delete();
            return true;
        });
    }
}
