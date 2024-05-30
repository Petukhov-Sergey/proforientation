<template>
    <div>
        <button class="btn btn-primary mb-3" @click="openCreateModal">Создать ответ</button>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Содержание</th>
                <th>Результаты</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="answer in answers" :key="answer.id">
                <td>{{ answer.id }}</td>
                <td>{{ answer.content }}</td>
                <td>
                    <span v-for="result in answer.results" :key="result.id">
                        {{ result.description }} (Рейтинг: {{ result.pivot.rating }})<br>
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm btn-secondary me-2" @click="openEditModal(answer)">Редактировать ответ</button>
                    <form @submit.prevent="deleteAnswer(answer.id)" style="display: inline;">
                        <button type="submit" class="btn btn-sm btn-danger me-2">Удалить</button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>

        <create-answer-modal ref="createAnswerModal" :results="results" :question-id="question.id"></create-answer-modal>
        <edit-answer-modal ref="editAnswerModal" :results="results" :question-id="question.id"></edit-answer-modal>
    </div>
</template>

<script>
import axios from 'axios';
import CreateAnswerModal from './CreateAnswerModal.vue';
import EditAnswerModal from './EditAnswerModal.vue';

export default {
    components: {
        CreateAnswerModal,
        EditAnswerModal
    },
    props: {
        question: Object,
        results: Array
    },
    data() {
        return {
            answers: []
        };
    },
    methods: {
        fetchAnswers() {
            axios.get(`/api/questions/${this.question.id}/answers`).then(response => {
                this.answers = response.data;
            });
        },
        openCreateModal() {
            this.$refs.createAnswerModal.openModal();
        },
        openEditModal(answer) {
            this.$refs.editAnswerModal.openModal(answer);
        },
        deleteAnswer(answerId) {
            axios.delete(`/api/answers/${answerId}`).then(() => {
                this.fetchAnswers();
            });
        }
    },
    mounted() {
        this.fetchAnswers();
    }
};
</script>
