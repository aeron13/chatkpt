import './bootstrap';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'

import apiStore from './store/api'
import csrfStore from './store/csrf'
import { darkMode } from './store/darkMode';

import { addCategoryForm } from './forms/addCategoryForm';
import { createCategoryForm } from './forms/createCategoryForm';
import { deleteCategoryForm } from './forms/deleteCategoryForm';
import { deleteConversationForm } from './forms/deleteConversationForm';
import { loadConversationsForm } from './forms/loadConversationsForm';
import { searchForm } from './forms/searchForm';
import { updateCategoryForm } from './forms/updateCategoryForm';
import { sidebar } from './partials/sidebar';
import { conversationsList } from './partials/conversationsList';
import { categoryPage } from './pages/categoryPage';
import { conversationPage } from './pages/conversationPage';
import { dashboardPage } from './pages/dashboardPage';

window.Alpine = Alpine;

Alpine.plugin(persist)

Alpine.store('api', apiStore)
Alpine.store('csrf', csrfStore)

document.addEventListener('alpine:init', () => {

    // persist
    Alpine.data('darkMode', darkMode)

    // forms
    Alpine.data('addCategoryForm', addCategoryForm)
    Alpine.data('createCategoryForm', createCategoryForm)
    Alpine.data('deleteCategoryForm', deleteCategoryForm)
    Alpine.data('deleteConversationForm', deleteConversationForm)
    Alpine.data('loadConversationsForm', loadConversationsForm)
    Alpine.data('searchForm', searchForm)
    Alpine.data('updateCategoryForm', updateCategoryForm)

    // partials
    Alpine.data('sidebar', sidebar)
    Alpine.data('conversationsList', conversationsList)

    // pages
    Alpine.data('categoryPage', categoryPage)
    Alpine.data('conversationPage', conversationPage)
    Alpine.data('dashboardPage', dashboardPage)

})

Alpine.start();