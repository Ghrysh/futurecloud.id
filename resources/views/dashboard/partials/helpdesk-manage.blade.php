<div x-data="helpdeskManager('{{ $licenseKey }}')">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Manajemen Helpdesk</h3>
            <p class="text-sm text-gray-500">Kelola akun helpdesk yang dapat membalas Live Chat. <br> URL Login Helpdesk: <a href="{{ route('helpdesk.login') }}" target="_blank" class="text-blue-600 hover:underline">{{ route('helpdesk.login') }}</a></p>
        </div>
        <button @click="openCreateModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition shadow-sm hover:shadow flex items-center gap-2">
            <i class="ri-user-add-line"></i> Tambah Helpdesk
        </button>
    </div>

    <!-- Error/Success Alert -->
    <div x-show="alertMessage" class="mb-4 p-4 rounded-lg flex items-center gap-3" :class="alertType === 'error' ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-green-50 text-green-700 border border-green-200'">
        <i :class="alertType === 'error' ? 'ri-error-warning-line' : 'ri-checkbox-circle-line'" class="text-xl"></i>
        <p class="text-sm font-medium" x-text="alertMessage"></p>
        <button @click="alertMessage = ''" class="ml-auto"><i class="ri-close-line"></i></button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-200">
                    <th class="px-6 py-4 font-semibold">Nama</th>
                    <th class="px-6 py-4 font-semibold">Email</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold">Login Terakhir</th>
                    <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr x-show="loading" class="animate-pulse">
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">Memuat data...</td>
                </tr>
                <tr x-show="!loading && users.length === 0">
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="ri-team-line text-2xl text-gray-400"></i>
                        </div>
                        <p class="font-medium text-gray-600 mb-1">Belum ada Helpdesk</p>
                        <p class="text-sm text-gray-400">Klik tombol Tambah Helpdesk untuk membuat akun baru.</p>
                    </td>
                </tr>
                <template x-for="user in users" :key="user.id">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">
                                    <span x-text="user.name.charAt(0).toUpperCase()"></span>
                                </div>
                                <span class="font-medium text-gray-800" x-text="user.name"></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600" x-text="user.email"></td>
                        <td class="px-6 py-4">
                            <button @click="toggleStatus(user.id)" class="px-2.5 py-1 text-xs font-semibold rounded-full border transition-colors focus:outline-none" :class="user.is_active ? 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100' : 'bg-gray-100 text-gray-500 border-gray-200 hover:bg-gray-200'">
                                <span x-text="user.is_active ? 'Aktif' : 'Nonaktif'"></span>
                            </button>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500" x-text="user.last_login_at ? new Date(user.last_login_at).toLocaleString() : 'Belum pernah login'"></td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button @click="openEditModal(user)" class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <button @click="confirmDeleteModal(user.id)" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors" title="Hapus">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Modal Form -->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
        <!-- Backdrop -->
        <div x-show="showModal" x-transition.opacity class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="closeModal()"></div>
        
        <!-- Modal Content -->
        <div x-show="showModal" x-transition.scale class="relative bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="font-bold text-gray-800 text-lg" x-text="isEditing ? 'Edit Helpdesk' : 'Tambah Helpdesk Baru'"></h3>
                <button @click="closeModal()" class="text-gray-400 hover:text-gray-600"><i class="ri-close-line text-xl"></i></button>
            </div>
            
            <form @submit.prevent="submitForm()" class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" x-model="form.name" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" x-model="form.email" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1" x-text="isEditing ? 'Password Baru (Opsional)' : 'Password'"></label>
                        <input type="password" x-model="form.password" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all" :required="!isEditing" minlength="6">
                    </div>
                    <div x-show="!isEditing || form.password">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" x-model="form.password_confirmation" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all" :required="!isEditing || form.password">
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" @click="closeModal()" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors flex items-center gap-2" :disabled="submitting">
                        <span x-show="submitting"><i class="ri-loader-4-line animate-spin"></i></span>
                        <span x-text="isEditing ? 'Simpan Perubahan' : 'Buat Akun'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-[60] flex items-center justify-center" style="display: none;">
        <!-- Backdrop -->
        <div x-show="showDeleteModal" x-transition.opacity class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="closeDeleteModal()"></div>
        
        <!-- Modal Content -->
        <div x-show="showDeleteModal" x-transition.scale class="relative bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden text-center p-6">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="ri-alert-line text-3xl text-red-600"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Hapus Akun?</h3>
            <p class="text-gray-500 mb-6 text-sm">Apakah Anda yakin ingin menghapus akun helpdesk ini? Tindakan ini tidak dapat dibatalkan.</p>
            
            <div class="flex gap-3 justify-center">
                <button @click="closeDeleteModal()" type="button" class="px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors w-full" :disabled="submitting">Batal</button>
                <button @click="confirmDelete()" type="button" class="px-5 py-2.5 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 transition-colors w-full flex justify-center items-center gap-2" :disabled="submitting">
                    <span x-show="submitting"><i class="ri-loader-4-line animate-spin"></i></span>
                    <span x-text="submitting ? 'Menghapus...' : 'Ya, Hapus'"></span>
                </button>
            </div>
        </div>
    </div>

</div>

<script>
    function helpdeskManager(licenseKey) {
        return {
            licenseKey: licenseKey,
            users: [],
            loading: true,
            showModal: false,
            isEditing: false,
            submitting: false,
            alertMessage: '',
            alertType: 'success',
            showDeleteModal: false,
            deleteId: null,
            form: {
                id: null,
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },

            init() {
                this.fetchUsers();
            },

            showAlert(msg, type = 'success') {
                this.alertMessage = msg;
                this.alertType = type;
                setTimeout(() => this.alertMessage = '', 5000);
            },

            async fetchUsers() {
                this.loading = true;
                try {
                    let res = await fetch(`/client-area/helpdesk-users?license=${this.licenseKey}`);
                    let json = await res.json();
                    if (json.data) {
                        this.users = json.data;
                    }
                } catch(e) {
                    this.showAlert('Gagal memuat data helpdesk', 'error');
                }
                this.loading = false;
            },

            openCreateModal() {
                this.isEditing = false;
                this.form = { id: null, name: '', email: '', password: '', password_confirmation: '' };
                this.showModal = true;
            },

            openEditModal(user) {
                this.isEditing = true;
                this.form = { id: user.id, name: user.name, email: user.email, password: '', password_confirmation: '' };
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
            },

            async submitForm() {
                if (this.form.password && this.form.password !== this.form.password_confirmation) {
                    this.showAlert('Konfirmasi password tidak cocok', 'error');
                    return;
                }

                this.submitting = true;
                
                try {
                    let url = '/client-area/helpdesk-users';
                    let method = 'POST';
                    let body = { ...this.form, license_key: this.licenseKey };
                    
                    if (this.isEditing) {
                        url = `/client-area/helpdesk-users/${this.form.id}`;
                        method = 'PUT';
                    }

                    let res = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(body)
                    });

                    let json = await res.json();

                    if (res.ok) {
                        this.showAlert(`Akun helpdesk berhasil ${this.isEditing ? 'diperbarui' : 'dibuat'}`);
                        this.closeModal();
                        this.fetchUsers();
                    } else {
                        let msg = json.error || json.message || 'Terjadi kesalahan';
                        if (json.errors) {
                            msg = Object.values(json.errors)[0][0];
                        }
                        this.showAlert(msg, 'error');
                    }
                } catch(e) {
                    this.showAlert('Terjadi kesalahan jaringan', 'error');
                }
                
                this.submitting = false;
            },

            confirmDeleteModal(id) {
                this.deleteId = id;
                this.showDeleteModal = true;
            },

            closeDeleteModal() {
                this.showDeleteModal = false;
                this.deleteId = null;
            },

            async confirmDelete() {
                if (!this.deleteId) return;
                this.submitting = true;
                
                try {
                    let res = await fetch(`/client-area/helpdesk-users/${this.deleteId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    
                    let json = await res.json().catch(() => ({}));
                    
                    if (res.ok) {
                        this.showAlert('Akun helpdesk berhasil dihapus');
                        this.fetchUsers();
                        this.closeDeleteModal();
                    } else {
                        this.showAlert(json.error || 'Gagal menghapus akun', 'error');
                        this.closeDeleteModal();
                    }
                } catch(e) {
                    this.showAlert('Terjadi kesalahan jaringan', 'error');
                    this.closeDeleteModal();
                }
                this.submitting = false;
            },

            async toggleStatus(id) {
                try {
                    let res = await fetch(`/client-area/helpdesk-users/${id}/toggle`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    
                    if (res.ok) {
                        this.fetchUsers();
                    } else {
                        this.showAlert('Gagal mengubah status', 'error');
                    }
                } catch(e) {
                    this.showAlert('Terjadi kesalahan jaringan', 'error');
                }
            }
        }
    }
</script>
