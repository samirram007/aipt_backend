<?php

namespace App\Modules\Agent\Services;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\Agent\Contracts\AgentServiceInterface;
use App\Modules\Agent\Models\Agent;
use Illuminate\Database\Eloquent\Collection;

class AgentService implements AgentServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Agent::with($this->resource)->get();
    }

    public function getById(int $id): ?Agent
    {
        return Agent::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Agent
    {

        $agent = Agent::create($data);
        $data['account_group_id'] = 2;
        if (isset($data['account_group_id'])) {

            $data['account_ledger']['name'] = $this->verifyUniqueLedgerName($agent->name, $agent->id);
            $data['account_ledger']['code'] = $data['account_ledger']['name'];
            $data['account_ledger']['account_group_id'] = $data['account_group_id'];
            $data['account_ledger']['ledgerable_type'] = 'agent';
            $data['account_ledger']['ledgerable_id'] = $agent->id;
            $agent->account_ledger()->create($data['account_ledger']);
        }

        return $agent;
    }

    private function verifyUniqueLedgerName(string $name, ?int $id = null): string
    {
        if (empty(trim($name))) {
            throw new \InvalidArgumentException('Ledger name cannot be empty.');
        }

        // Normalize the name
        $baseName = trim($name);
        $uniqueName = $baseName;
        $counter = 1;
        //dd(AccountLedger::ledgerNameExists($uniqueName));
        // Check for uniqueness
        while (AccountLedger::ledgerNameExists($uniqueName)) {
            // dd($uniqueName);
            $uniqueName = sprintf('%s-%04d', $baseName, $counter);
            $counter++;
        }

        return $uniqueName;

    }

    public function update(array $data, int $id): Agent
    {
        $record = Agent::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Agent::findOrFail($id);
        return $record->delete();
    }
}
