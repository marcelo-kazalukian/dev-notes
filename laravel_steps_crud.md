# Steps for a CRUD feature in Laravel

Generate model, migration, factory, and seed
```console
php artisan make:model ModelName -mfs
```

Add columns in the migration
```php
Schema::create('model_name', static function (Blueprint $table) {
    $table->id();
    $table->foreignId('model_name_id')->constrained();
    $table->string('value');
    $table->timestamps();
});
```

Add fillable values and relationships in the model
```php
protected $fillable = [
    'model_name_id',
    'value',
];

public function attribute(): BelongsTo
{
    return $this->belongsTo(ModelName::class);
}
```
