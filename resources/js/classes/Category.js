export class Category {
    constructor(data, children, selected) {
        this.id = data.id
        this.name = data.name
        this.color = data.color
        this.parent_id = data.parent_id
        this.children = children
        this.selected = selected
    }
}