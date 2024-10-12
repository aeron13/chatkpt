import './bootstrap';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'

import apiStore from './store/api'
import csrfStore from './store/csrf'

import { addCategoryForm } from './forms/addCategoryForm';
import { createCategoryForm } from './forms/createCategoryForm';
import { deleteCategoryForm } from './forms/deleteCategoryForm';
import { deleteConversationForm } from './forms/deleteConversationForm';
import { loadConversationsForm } from './forms/loadConversationsForm';
import { searchForm } from './forms/searchForm';
import { updateCategoryForm } from './forms/updateCategoryForm';

window.Alpine = Alpine;

Alpine.plugin(persist)

Alpine.store('api', apiStore)
Alpine.store('csrf', csrfStore)

document.addEventListener('alpine:init', () => {
    Alpine.data('addCategoryForm', addCategoryForm)
    Alpine.data('createCategoryForm', createCategoryForm)
    Alpine.data('deleteCategoryForm', deleteCategoryForm)
    Alpine.data('deleteConversationForm', deleteConversationForm)
    Alpine.data('loadConversationsForm', loadConversationsForm)
    Alpine.data('searchForm', searchForm)
    Alpine.data('updateCategoryForm', updateCategoryForm)
})

Alpine.start();