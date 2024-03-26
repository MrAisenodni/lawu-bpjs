<?php

namespace App\Services;

class RegistrationService
{
    public function __construct(
        PatientRepositoryInterface $patientRepository, LogProcessRepositoryInterface $logProcessRepository,
        ProviderRepositoryInterface $providerRepository
    )
    {
        $this->patientRepository = $patientRepository;
        $this->logProcessRepository = $logProcessRepository;
        $this->providerRepository = $providerRepository;
    }

    /**
     * Get all patients from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->patientRepository->getAll();
    }
}