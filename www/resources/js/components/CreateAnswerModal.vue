<template>
    <div class="modal fade" id="createAnswerModal" tabindex="-1" aria-labelledby="createAnswerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAnswerModalLabel">Создать ответ</h5>
                    <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="saveChanges">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="answerContent">Содержание ответа</label>
                            <input type="text" class="form-control" id="answerContent" v-model="answer.content" required>
                        </div>
                        <div class="form-group">
                            <label for="results">Результаты</label>
                            <div v-for="result in results" :key="result.id" class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" :value="result.id" v-model="answer.results">
                                <label class="form-check-label">{{ result.title }}</label>
                                <input type="number" class="form-control mt-1" v-model="answer.ratings[result.id]" min="0" max="1" step="0.01" placeholder="Рейтинг">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </form>
                <div v-if="errors.length" class="alert alert-danger mt-3">
                    <ul>
                        <li v-for="error in errors" :key="error">{{ error }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Modal } from 'bootstrap';

export default {
    props: {
        results: {
            type: Array,
            default: () => []
        },
        questionId: {
            type: Number,
            required: true
        }
    },
    setup(props) {
        const answer = ref({
            content: '',
            results: [],
            ratings: {}
        });
        const errors = ref([]);
        let modalInstance;

        const openModal = () => {
            resetForm();
            modalInstance.show();
        };

        const closeModal = () => {
            modalInstance.hide();
        };

        const resetForm = () => {
            answer.value = {
                content: '',
                results: [],
                ratings: {}
            };
        };

        const saveChanges = () => {
            errors.value = [];
            axios.post(`/editor/questions/${props.questionId}/answers`, {
                content: answer.value.content,
                results: answer.value.results,
                ratings: answer.value.ratings
            })
                .then(response => {
                    window.location.reload();
                })
                .catch(error => {
                    if (error.response && error.response.data && error.response.data.errors) {
                        errors.value = Object.values(error.response.data.errors).flat();
                    } else {
                        console.error(error);
                    }
                });
        };

        onMounted(() => {
            modalInstance = new Modal(document.getElementById('createAnswerModal'));
        });

        return {
            answer,
            errors,
            openModal,
            closeModal,
            saveChanges
        };
    }
};
</script>
