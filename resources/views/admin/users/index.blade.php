<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                <i class="fas fa-users-cog mr-2 text-purple-400"></i>
                Gestión de Usuarios
            </h2>
            <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-cb-green text-white rounded-lg hover:bg-cb-green/80 transition-all text-sm font-medium">
                <i class="fas fa-user-plus mr-2"></i>
                Nuevo Usuario
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 px-6 py-4 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filtros y búsqueda -->
            <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-6 mb-6">
                <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Búsqueda -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-search mr-2"></i>Buscar por nombre o email
                        </label>
                        <input type="text" 
                            name="search" 
                            id="search"
                            value="{{ request('search') }}"
                            placeholder="Escribe un nombre o email..."
                            class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cb-green">
                    </div>

                    <!-- Filtro por rol -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-user-tag mr-2"></i>Filtrar por rol
                        </label>
                        <select name="role" 
                                id="role"
                                class="w-full bg-cb-dark border border-cb-border rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cb-green">
                            <option value="">Todos los roles</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="md:col-span-3 flex gap-3">
                        <button type="submit" class="px-6 py-2 bg-cb-green text-white rounded-lg hover:bg-cb-green/80 transition-all font-medium">
                            <i class="fas fa-filter mr-2"></i>Filtrar
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition-all font-medium">
                            <i class="fas fa-times mr-2"></i>Limpiar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tabla de usuarios -->
            <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-cb-border">
                        <thead class="bg-cb-dark">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Usuario
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Rol
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Registro
                                </th>
                                <th class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cb-border">
                            @forelse($users as $user)
                                <tr class="hover:bg-cb-dark/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-cb-green/20 rounded-full flex items-center justify-center">
                                                @if($user->hasRole('super_admin'))
                                                    <i class="fas fa-shield-halved text-purple-400"></i>
                                                @elseif($user->hasRole('admin'))
                                                    <i class="fas fa-crown text-yellow-400"></i>
                                                @elseif($user->hasRole('juez'))
                                                    <i class="fas fa-gavel text-blue-400"></i>
                                                @else
                                                    <i class="fas fa-user text-gray-400"></i>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-white">
                                                    {{ $user->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-300">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->hasRole('super_admin'))
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-500/20 text-purple-400 border border-purple-500/30">
                                                <i class="fas fa-shield-halved mr-1"></i> Super Admin
                                            </span>
                                        @elseif($user->hasRole('admin'))
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                                                <i class="fas fa-crown mr-1"></i> Admin
                                            </span>
                                        @elseif($user->hasRole('juez'))
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/30">
                                                <i class="fas fa-gavel mr-1"></i> Juez
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-500/20 text-gray-400 border border-gray-500/30">
                                                <i class="fas fa-user mr-1"></i> Usuario
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- Ver detalles -->
                                            <a href="{{ route('admin.users.show', $user) }}" 
                                               class="text-blue-400 hover:text-blue-300 transition-colors"
                                               title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if(!$user->hasRole('super_admin'))
                                                <!-- Editar -->
                                                <a href="{{ route('admin.users.edit', $user) }}" 
                                                   class="text-yellow-400 hover:text-yellow-300 transition-colors"
                                                   title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Eliminar -->
                                                @if($user->id !== auth()->id())
                                                    <form method="POST" 
                                                          action="{{ route('admin.users.destroy', $user) }}" 
                                                          onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')"
                                                          class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="text-red-400 hover:text-red-300 transition-colors"
                                                                title="Eliminar">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                <span class="text-gray-600" title="Protegido">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        <i class="fas fa-users text-4xl mb-4"></i>
                                        <p>No se encontraron usuarios.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($users->hasPages())
                    <div class="bg-cb-dark px-6 py-4 border-t border-cb-border">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

            <!-- Estadísticas -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Total Usuarios</p>
                            <p class="text-2xl font-bold text-white">{{ $users->total() }}</p>
                        </div>
                        <i class="fas fa-users text-3xl text-gray-600"></i>
                    </div>
                </div>
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Administradores</p>
                            <p class="text-2xl font-bold text-yellow-400">{{ \App\Models\User::role('admin')->count() }}</p>
                        </div>
                        <i class="fas fa-crown text-3xl text-yellow-600"></i>
                    </div>
                </div>
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Jueces</p>
                            <p class="text-2xl font-bold text-blue-400">{{ \App\Models\User::role('juez')->count() }}</p>
                        </div>
                        <i class="fas fa-gavel text-3xl text-blue-600"></i>
                    </div>
                </div>
                <div class="bg-cb-card rounded-lg shadow-xl border border-cb-border p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm">Participantes</p>
                            <p class="text-2xl font-bold text-gray-400">{{ \App\Models\User::role('user')->count() }}</p>
                        </div>
                        <i class="fas fa-user text-3xl text-gray-600"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
