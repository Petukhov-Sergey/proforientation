import { createApp } from 'vue';
import EditTestModal from './components/EditTestModal.vue';
import EditQuestionModal from './components/EditQuestionModal.vue';
import EditAnswerModal from './components/EditAnswerModal.vue';
import CreateAnswerModal from './components/CreateAnswerModal.vue';
import Answers from './components/Answers.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

const app = createApp({
    methods: {
        openTestModal(testData) {
            this.$refs.editTestModal.openModal(testData);
        },
        openQuestionModal(questionData) {
            this.$refs.editQuestionModal.openModal(questionData);
        },
        openAnswerModal(answerData) {
            this.$refs.editAnswerModal.openModal(answerData);
        },
        openCreateAnswerModal() {
            this.$refs.createAnswerModal.openModal();
        }
    }
});

app.component('edit-test-modal', EditTestModal);
app.component('edit-question-modal', EditQuestionModal);
app.component('edit-answer-modal', EditAnswerModal);
app.component('create-answer-modal', CreateAnswerModal);
app.component('answers', Answers);

app.mount('#app');
