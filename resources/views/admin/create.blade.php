@extends('navbar.nav')

@section('content')
<div class="container">
    <h2>Create Blog Post</h2>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" class="form-control mb-3" placeholder="Post Title">
        @error('title')
        <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="status" class="form-label">Post Status</label>
            <select name="status" id="status" class="form-select">
                <option value="published">Public</option>
                <option value="archived">Private</option>
                <option value="draft">Draft</option>
            </select>
        </div>
        @error('status')
        <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <div class="mb-2">
                <button type="button" onclick="insert('h1')">Heading</button>
                <button type="button" onclick="insert('p')">Paragraph</button>
                <button type="button" onclick="insertImage()">Image</button>
                <button type="button" onclick="insertLink()">Link</button>
            </div>
            <div id="editor" contenteditable="true" style="min-height: 300px; border: 1px solid #ccc; padding: 10px;">
            </div>
            <input type="hidden" name="content" id="content">
            @error('content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary" onclick="prepareSubmit()">Save Post</button>
    </form>
</div>

<script>
function insert(tag) {
    let selection = window.getSelection();
    let range = selection.getRangeAt(0);
    let el = document.createElement(tag);
    el.innerHTML = 'Type your ' + tag;
    range.insertNode(el);
    range.setStartAfter(el);
    range.setEndAfter(el);
    selection.removeAllRanges();
    selection.addRange(range);
}

function insertImage() {
    let url = prompt("Enter image URL:");
    if (url) {
        let img = document.createElement("img");
        img.src = url;
        img.style.maxWidth = "100%";
        let range = window.getSelection().getRangeAt(0);
        range.insertNode(img);
    }
}

function insertLink() {
    let url = prompt("Enter link URL:");
    let text = prompt("Enter link text:");
    if (url && text) {
        let a = document.createElement("a");
        a.href = url;
        a.innerText = text;
        a.target = "_blank";
        let range = window.getSelection().getRangeAt(0);
        range.insertNode(a);
    }
}

function prepareSubmit() {
    document.getElementById('content').value = document.getElementById('editor').innerHTML;
}
</script>
@endsection