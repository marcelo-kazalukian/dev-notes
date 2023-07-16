
# Steps to create everything related to an "Entity"

Generate models and migrations
```
php artisan make:model Role -m
php artisan make:migration add_role_id_to_users_table
```

Roles Migration
```php
public function up(): void
{
    Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });
}
```

Add columns in $fillable variable in app/Models/Role.php:
```php
class Role extends Model
{
    use HasFactory;
 
    protected $fillable = ['name'];
}

Adding Role ID Migration:
```php
Schema::table('users', function (Blueprint $table) {
    $table->foreignId('role_id')->constrained();
});
```
