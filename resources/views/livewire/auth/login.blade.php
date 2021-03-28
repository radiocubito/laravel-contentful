<div>
    <form wire:submit.prevent="login">
        <div>
            <label for="email">
                Email address
            </label>
            <div>
                <input wire:model="email" id="email" type="email" required autofocus />
            </div>
            @error('email') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="password">
                Password
            </label>
            <div>
                <input wire:model.lazy="password" id="password" type="password" required />
            </div>
            @error('password') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <span>
                <button type="submit">
                    Log In
                </button>
            </span>
        </div>
    </form>
</div>
