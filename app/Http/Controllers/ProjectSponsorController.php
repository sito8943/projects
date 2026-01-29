<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Purchase;
use Mollie\Api\Http\Data\Money;
use Mollie\Api\Http\Requests\CreatePaymentRequest;
use Mollie\Laravel\Facades\Mollie;

class ProjectSponsorController extends Controller
{
    public function preparePayment(Project $project)
    {

        $amount_cents = request()->amount * 100;

        $webhook_url = route('api.mollie.webhook');

        $user = auth()->user();

        $purchase = Purchase::create([
            'user_id' => $user->id,
            'project_id' => $project->id,
            'amount_cents' => $amount_cents,
        ]);

        $request = new CreatePaymentRequest(
            description: 'Sponsoring project: '.$project->name.' by '.$project->author->name,
            amount: new Money('EUR', number_format($amount_cents / 100, 2, '.', '')),
            redirectUrl: route('projects.show', ['project' => $project->slug, 'purchase' => $purchase->id]),
            webhookUrl: $webhook_url,
            metadata: [
                'order_id' => "# $purchase->id",
                'project_id' => $project->id,
                'customer_info' => [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]
        );

        $payment = Mollie::send($request);

        $purchase->update([
            'mollie_payment_id' => $payment->id,
        ]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }
    //
}
