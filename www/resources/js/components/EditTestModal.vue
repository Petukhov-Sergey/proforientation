<template>
    <div class="modal fade" id="editTestModal" tabindex="-1" aria-labelledby="editTestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTestModalLabel">Редактировать тест</h5>
                    <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="saveChanges">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="testTitle">Название теста</label>
                            <input type="text" class="form-control" id="testTitle" v-model="test.title" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Modal } from 'bootstrap';

export default {
    setup() {
        const test = ref({ id: '', title: '' });
        let modalInstance;

        function openModal(testData) {
            test.value = { ...testData };
            modalInstance.show();
        }

        function closeModal() {
            modalInstance.hide();
            resetForm();
        }

        function resetForm() {
            test.value = { id: '', title: '' };
        }

        function saveChanges() {
            axios.put(`/editor/tests/${test.value.id}`, { title: test.value.title })
                .then(response => {
                    document.querySelector(`#test-title-${test.value.id}`).innerText = test.value.title;
                    closeModal();
                })
                .catch(error => {
                    console.error(error);
                });
        }

        onMounted(() => {
            modalInstance = new Modal(document.getElementById('editTestModal'));
        });

        return {
            test,
            openModal,
            closeModal,
            saveChanges
        };
    }
}
</script>
