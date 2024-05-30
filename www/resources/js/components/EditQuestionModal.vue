<template>
    <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQuestionModalLabel">Редактировать вопрос</h5>
                    <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="saveChanges">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="questionContent">Содержание вопроса</label>
                            <input type="text" class="form-control" id="questionContent" v-model="question.content" required>
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
        const question = ref({ id: '', content: '', test_id: '' });
        let modalInstance;

        function openModal(questionData) {
            question.value = { ...questionData };
            modalInstance.show();
        }

        function closeModal() {
            modalInstance.hide();
            resetForm();
        }

        function resetForm() {
            question.value = { id: '', content: '', test_id: '' };
        }

        function saveChanges() {
            axios.put(`/editor/tests/${question.value.test_id}/questions/${question.value.id}`, { content: question.value.content })
                .then(response => {
                    document.querySelector(`#question-content-${question.value.id}`).innerText = question.value.content;
                    closeModal();
                })
                .catch(error => {
                    console.error(error);
                });
        }

        onMounted(() => {
            modalInstance = new Modal(document.getElementById('editQuestionModal'));
        });

        return {
            question,
            openModal,
            closeModal,
            saveChanges
        };
    }
}
</script>
