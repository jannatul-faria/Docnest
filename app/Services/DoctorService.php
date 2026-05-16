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
    ) {
    }

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
            // 1. Create Doctor Profile
            $doctorData = [
                'user_id' => null, // Making it optional for future
                'name' => $data['name'],
                'email' => $data['email'],
                'department_id' => $data['department_id'],
                'specialization' => $data['specialization'] ?? 'N/A',
                'experience_years' => $data['experience_years'] ?? 0,
                'consultation_fee' => $data['consultation_fee'] ?? 0,
                'hospital_name' => $data['hospital_name'] ?? null,
                'bio' => $data['bio'] ?? null,
                'status' => $data['status'] ?? true,
                'is_featured' => $data['is_featured'] ?? false,
                'social_links' => $data['social_links'] ?? null,
            ];

            $doctor = $this->repository->create($doctorData);

            // 2. Handle Profile Image
            if (isset($data['profile_image'])) {
                $extension = $data['profile_image']->getClientOriginalExtension();
                $fileName = $doctor->id . '_image.' . $extension;
                $doctor->addMedia($data['profile_image'])
                       ->usingFileName($fileName)
                       ->toMediaCollection('profile_image');
            }

            // 3. Handle Educations
            if (isset($data['educations']) && is_array($data['educations'])) {
                foreach ($data['educations'] as $edu) {
                    if (!empty($edu['degree']) && !empty($edu['institution']) && !empty($edu['passing_year'])) {
                        $doctor->educations()->create($edu);
                    }
                }
            }

            // 4. Handle Experiences
            if (isset($data['experiences']) && is_array($data['experiences'])) {
                foreach ($data['experiences'] as $exp) {
                    if (!empty($exp['designation']) && !empty($exp['institution']) && !empty($exp['start_date'])) {
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
            // 1. Update Doctor Profile
            if (empty($data['specialization'])) {
                $data['specialization'] = 'N/A';
            }
            
            // If the doctor has a user attached, update the user as well for backward compatibility
            if ($doctor->user) {
                $doctor->user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                ]);
            }

            $this->repository->update($doctor, $data);

            // 2. Handle Profile Image
            if (isset($data['profile_image'])) {
                $doctor->clearMediaCollection('profile_image');
                $extension = $data['profile_image']->getClientOriginalExtension();
                $fileName = $doctor->id . '_image.' . $extension;
                $doctor->addMedia($data['profile_image'])
                       ->usingFileName($fileName)
                       ->toMediaCollection('profile_image');
            }

            // 3. Handle Educations
            if (isset($data['educations']) && is_array($data['educations'])) {
                $doctor->educations()->delete();
                foreach ($data['educations'] as $edu) {
                    if (!empty($edu['degree']) && !empty($edu['institution']) && !empty($edu['passing_year'])) {
                        $doctor->educations()->create($edu);
                    }
                }
            }

            // 4. Handle Experiences
            if (isset($data['experiences']) && is_array($data['experiences'])) {
                $doctor->experiences()->delete();
                foreach ($data['experiences'] as $exp) {
                    if (!empty($exp['designation']) && !empty($exp['institution']) && !empty($exp['start_date'])) {
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
            if ($user) {
                $user->delete();
            }
            return true;
        });
    }
}
