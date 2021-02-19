@csrf

@include('backstage.partials.forms.text', [
    'field' => 'title',
    'label' => 'Title',
    'value' => old('title') ?? $prize->title,
])

@include('backstage.partials.forms.text', [
    'field' => 'description',
    'label' => 'Description',
    'value' => old('description') ?? $prize->description,
])

@include('backstage.partials.forms.number', [
    'field' => 'weight',
    'label' => 'Weight',
    'step' => 1,
    'value' => old('weight') ?? $prize->weight,
])


@include('backstage.partials.forms.starts-ends', [
    'starts_at' => old('starts_at') ?? ($prize->starts_at === null ? $prize->starts_at : $prize->starts_at->format('d-m-Y H:i:s')),
    'ends_at' => old('ends_at') ?? ($prize->ends_at === null ? $prize->ends_at : $prize->ends_at->format('d-m-Y H:i:s')),
    'minDate' => $activeCampaign->starts_at,
    'maxDate' => $activeCampaign->ends_at,
])


@includeWhen(empty($disabled), 'backstage.partials.forms.submit')
