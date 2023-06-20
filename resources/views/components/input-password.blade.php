<div class="input-style-2">
    <label>Senha</label>
    <input 
        type="password" 
        placeholder="Senha" 
        name="password" 
        class="form-control {{$class}}" 
        {{$required}} 
        autocomplete="current-password" 
        {{ !empty($pattern) ? 'pattern='.$pattern : '' }}
    />
    <span class="icon">
        <i class="fas fa-eye" id="icon-password"></i>
    </span>
    <div class="invalid-feedback">
        A senha deve ter no mínimo 8 caracteres.
    </div>
</div>

@push('password')
    <script src="{{ asset('js/password/password.js') }}"></script>
@endpush