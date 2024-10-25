<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form action="{{ route('user.edit-every-field', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
    </div>

    <!-- Last Name -->
    <div class="mb-3">
        <label for="last_name" class="form-label">Prénom </label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
    </div>

    <!-- Telephone -->
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone</label>
        <input type="tel" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $user->telephone) }}" required>
    </div>

    <!-- Adresse -->
    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse</label>
        <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $user->adresse) }}" required>
    </div>

    <!-- Image de Profil -->
    <div class="mb-3">
        <label for="image_de_profil" class="form-label">Photo de profile</label>
        <input type="file" class="form-control" id="image_de_profil" name="image_de_profil">
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Mettre à jour le profil</button>
</form>
</section>
