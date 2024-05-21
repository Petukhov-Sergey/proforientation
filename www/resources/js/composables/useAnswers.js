// useAnswers.js
import { ref } from 'vue';
import axios from 'axios';

export function useAnswers(questionId) {
    const answers = ref([]);
    const answer = ref(null);
    const errors = ref([]);

    const fetchAnswers = async () => {
        try {
            const response = await axios.get(`/api/questions/${questionId}/answers`);
            answers.value = response.data;
        } catch (error) {
            console.error(error);
        }
    };

    const createAnswer = async (data) => {
        try {
            const response = await axios.post(`/api/questions/${questionId}/answers`, data);
            answers.value.push(response.data);
        } catch (error) {
            errors.value = error.response.data.errors;
        }
    };

    const updateAnswer = async (id, data) => {
        try {
            const response = await axios.put(`/api/questions/${questionId}/answers/${id}`, data);
            const index = answers.value.findIndex(a => a.id === id);
            answers.value[index] = response.data;
        } catch (error) {
            errors.value = error.response.data.errors;
        }
    };

    const deleteAnswer = async (id) => {
        try {
            await axios.delete(`/api/questions/${questionId}/answers/${id}`);
            answers.value = answers.value.filter(a => a.id !== id);
        } catch (error) {
            console.error(error);
        }
    };

    return {
        answers,
        answer,
        errors,
        fetchAnswers,
        createAnswer,
        updateAnswer,
        deleteAnswer
    };
}
