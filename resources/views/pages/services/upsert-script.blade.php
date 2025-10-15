<script>
    let materials = JSON.parse(@json(is_string(@$service->materials) ? @$service->materials : json_encode(@$service->materials ?? [])));

    /**
     * Adjust price input based on pricing mode
     */
    const onChangePricingMode = (event) => {
        const {
            value = 'FIXED'
        } = event.target;

        let title = ""
        let placeholder = "";

        const priceInput = document.getElementById('price');
        const labelElement = document.querySelector('label[for="price"]');

        switch (value) {
            case 'FIXED':
                title = 'Harga';
                placeholder = 'Masukkan Harga';
                break;
            case 'MARKUP_PERCENTAGE':
                title = 'Kenaikan Harga (%)';
                placeholder = 'Masukkan Kenaikan Harga (dalam persen)';
                break;
            case "MARKUP_AMOUNT":
                title = 'Kenaikan Harga (dalam nominal)';
                placeholder = 'Masukkan Kenaikan Harga (dalam nominal)';
                break;
        }

        priceInput.title = title;
        priceInput.placeholder = placeholder;
        labelElement.textContent = title;
    }

    /**
     * Select material
     */
    const onSelectMaterial = (material) => {
        // Close modal
        document.getElementById('select-material-modal').classList.toggle('hidden');
        materials.push({
            ...material,
            id: null,
            material_id: material.id,
            quantity: 1,
        });
        renderMaterialsTable();
    }

    /**
     * Render materials data to table
     */
    const renderMaterialsTable = () => {
        const materialsTableBody = document.getElementById('materials-table-body');
        materialsTableBody.innerHTML = '';

        if (materials.length === 0) {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td colspan="4" class="text-center">Tidak ada bahan yang dipilih</td>
            `;
            materialsTableBody.appendChild(row);
            return;
        } else {
            materials.forEach((material, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${material.name}</td>
                <td><input type="number" value="${material.quantity ?? 1}" min="1" onchange="onChangeMaterialQuantity(${index}, this.value)" /></td>
                <td>${material.unit}</td>
                <td><button class="text-red-500 hover:text-red-700 cursor-pointer" onclick="onRemoveMaterial(${index})">Hapus</button></td>
            `;
                materialsTableBody.appendChild(row);
            });
        }
    }

    /**
     * Remove material
     */
    const onRemoveMaterial = (index) => {
        materials.splice(index, 1);
        renderMaterialsTable();
    }

    /**
     * Change material quantity
     */
    const onChangeMaterialQuantity = (index, value) => {
        // Validate quantity
        if (value < 1) {
            alert('Jumlah bahan harus lebih dari 0');
            // Set input value to 1
            document.querySelectorAll('input[type="number"]')[index].value = 1;
            return;
        }

        materials[index].quantity = value;
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderMaterialsTable();
    });

    /**
     * Store service
     */
    const store = (event) => {
        const form = document.getElementById('service-form');
        const formData = new FormData(form);
        const materialsInput = document.getElementById('materials');

        // Add materials to form data
        materialsInput.value = JSON.stringify(materials);

        // Submit in no async/await
        form.submit();
    }

    /**
     * Update service
     */
    const update = (event) => {
        const form = document.getElementById('service-form');
        const formData = new FormData(form);
        const materialsInput = document.getElementById('materials');

        // Add materials to form data
        materialsInput.value = JSON.stringify(materials);

        // Submit in no async/await
        form.submit();
    }

    /**
     * Delete service
     */
    const onDeleteService = async () => {
        const {isConfirmed} = await Swal.fire({
            title: "Apakah Anda yakin menghapus layanan ini?",
            text: "Data layanan akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus layanan!"
        })

        if (isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('services.destroy', $service->id) }}";

            const csrf = document.createElement('input');
            csrf.type = 'text';
            csrf.name = '_token';
            csrf.value = "{{ csrf_token() }}";
            form.appendChild(csrf);

            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();
        }
    };
</script>

@error('materials')
@push('scripts')
<script>
    Swal.fire({
        title: "Terjadi Kesalahan",
        text: '{{ \Illuminate\Support\Str::ucfirst($message) }}',
        icon: "error"
    });
</script>
@endpush
@enderror