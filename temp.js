    function saasConfig() {
        return {
            step: 1, mode: '', searchQuery: '', isLoading: false,
            domainResult: null, isAvailable: false,
            
            // Harga
            saasPrice: {{ $price }},
            domainPrice: 0,
            
            selectedDomain: '',

            get domainStatusText() {
                if(this.mode === 'new') return 'Registrasi Baru (1 Thn)';
                if(this.mode === 'own_futurecloud') return 'Domain Terdaftar';
                return 'Domain Eksternal';
            },

            setMode(mode) {
                this.mode = mode; this.step = 2; this.searchQuery = ''; 
                this.domainResult = null; this.selectedDomain = ''; this.domainPrice = 0;
            },
            resetStep() {
                this.step = 1; this.mode = ''; this.selectedDomain = ''; this.domainPrice = 0;
            },

            async checkDomain() {
                if(!this.searchQuery) return;
                this.isLoading = true; this.domainResult = null;
                let dom = this.searchQuery.toLowerCase(); if(!dom.includes('.')) dom += '.com';

                try {
                    const csrf = document.querySelector('input[name="_token"]').value;
                    const res = await fetch('/check-domain-availability', {
                        method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                        body: JSON.stringify({ domain: dom })
                    });
                    const data = await res.json();
                    
                    if (data.main) {
                        this.domainResult = data.main.domain;
                        this.isAvailable = data.main.available;
                        // Simpan harga integer dari backend
                        this.tempPrice = data.main.price_final; 
                    }
                } catch(e) { console.error(e); } 
                finally { this.isLoading = false; }
            },

            selectDomain(domain, price) {
                this.selectedDomain = domain;
                this.domainPrice = price; // Update harga domain
            },

            useExternalDomain() {
                let dom = this.searchQuery.trim().toLowerCase();
                if (!dom.match(/^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,10}$/)) { customAlert('Format domain salah'); return; }
                this.selectDomain(dom, 0); // Domain luar = Gratis (karena sudah punya)
            },

            calculateTotal() {
                return this.saasPrice + this.domainPrice;
            },

            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
            }
        }
    }
