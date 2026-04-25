<section>
    <header>
        <h3>Informations du profil</h3>
        <p>
            Mettez à jour vos informations personnelles et, si vous êtes médecin, vos informations professionnelles.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- SECTION PHOTO -->
        <div style="text-align: center; margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 10px; font-weight: 600;">Photo de profil</label>
            
            <!-- PHOTO ACTUELLE / PREVIEW -->
            <img id="preview"
                 src="{{ $user->photo ? asset('photos/'.$user->photo) : asset('images/default.png') }}"
                 style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; cursor: pointer; border: 2px solid #e5e7eb;">
            
            <br><br>

            <!-- INPUT FILE (caché) -->
            <input type="file" name="photo" id="photoInput" accept="image/*" hidden>

            <!-- BOUTONS PHOTO -->
            <div style="display: flex; gap: 10px; justify-content: center; margin-bottom: 20px; flex-wrap: wrap;">
                <button type="button" onclick="openFile()" style="background: #3b82f6; padding: 8px 16px; border: none; border-radius: 8px; color: white; cursor: pointer;">
                    📁 Importer depuis PC / Galerie
                </button>
                <button type="button" onclick="deletePhoto()" style="background: #ef4444; padding: 8px 16px; border: none; border-radius: 8px; color: white; cursor: pointer;" id="deletePhotoBtn">
                    🗑️ Supprimer la photo
                </button>
            </div>
            
            @error('photo')
                <div style="color: red; font-size: 12px; margin-top: 10px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="name">Nom complet</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input
                id="email"
                type="email"
                value="{{ $user->email }}"
                disabled
            >
            <p style="font-size:13px;color:#6b7280;margin-top:6px;">
                L'adresse email ne peut pas être modifiée.
            </p>
        </div>

        <div class="form-group">
            <label for="role_display">Type de compte</label>
            <input
                id="role_display"
                type="text"
                value="{{ ucfirst($user->role) }}"
                disabled
            >
        </div>

        @if($user->role === 'medecin')
            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input
                    id="phone"
                    name="phone"
                    type="text"
                    value="{{ old('phone', $user->phone) }}"
                    placeholder="Ex : 22 123 456"
                >
                @error('phone')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="speciality">Spécialité</label>
                <input
                    id="speciality"
                    name="speciality"
                    type="text"
                    value="{{ old('speciality', $user->speciality) }}"
                    placeholder="Ex : Cardiologie"
                >
                @error('speciality')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Adresse du cabinet</label>
                <input
                    id="address"
                    name="address"
                    type="text"
                    value="{{ old('address', $user->address) }}"
                    placeholder="Adresse du cabinet"
                >
                @error('address')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="license_number">Numéro d'autorisation</label>
                <input
                    id="license_number"
                    name="license_number"
                    type="text"
                    value="{{ old('license_number', $user->license_number) }}"
                    placeholder="Numéro d'autorisation"
                >
                @error('license_number')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="status-text" style="margin-top: 10px;">
                Ces informations complètent votre profil professionnel médecin.
            </div>
        @endif

        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap; margin-top: 20px;">
            <button type="submit" style="background: #3a7bd5; padding: 10px 20px; border: none; border-radius: 8px; color: white; cursor: pointer;">
                💾 Enregistrer
            </button>

            @if (session('status') === 'profile-updated')
                <span style="color: #10b981; font-size: 14px;">
                    ✓ Modifications enregistrées.
                </span>
            @endif
            
            @if (session('status') === 'photo-deleted')
                <span style="color: #10b981; font-size: 14px;">
                    ✓ Photo supprimée avec succès.
                </span>
            @endif
        </div>
    </form>
</section>

<!-- JAVASCRIPT POUR LA GESTION DE LA PHOTO -->
<script>
function openFile() {
    let input = document.getElementById('photoInput');
    input.removeAttribute('capture');
    input.click();
}

function deletePhoto() {
    if (confirm('⚠️ Êtes-vous sûr de vouloir supprimer votre photo de profil ?')) {
        // Créer un formulaire pour la suppression
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("profile.photo.destroy") }}';
        form.style.display = 'none';
        
        let csrf = document.createElement('input');
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);
        
        let method = document.createElement('input');
        method.name = '_method';
        method.value = 'DELETE';
        form.appendChild(method);
        
        document.body.appendChild(form);
        form.submit();
    }
}

// PREVIEW DE L'IMAGE SÉLECTIONNÉE
document.getElementById('photoInput').addEventListener('change', function(e) {
    let file = e.target.files[0];
    if (file) {
        // Vérification taille (max 2 Mo)
        if (file.size > 2 * 1024 * 1024) {
            alert('❌ Le fichier est trop volumineux (max 2 Mo)');
            this.value = '';
            return;
        }
        
        // Vérification type
        if (!file.type.startsWith('image/')) {
            alert('❌ Veuillez sélectionner une image valide (JPG, PNG, GIF)');
            this.value = '';
            return;
        }
        
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Si l'utilisateur a déjà une photo, afficher le bouton supprimer, sinon le cacher
document.addEventListener('DOMContentLoaded', function() {
    let deleteBtn = document.getElementById('deletePhotoBtn');
    let hasPhoto = '{{ $user->photo }}';
    if (!hasPhoto) {
        deleteBtn.style.display = 'none';
    }
});
</script>