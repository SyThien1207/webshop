<style>
    .row {
        position: absolute;
        top: 50px;
        /* Điều chỉnh theo nhu cầu */
        left: 20px;
        /* Điều chỉnh theo nhu cầu */
        width: 80%;
        /* Điều chỉnh chiều rộng theo nhu cầu */
        height: auto;
        /* Điều chỉnh chiều cao theo nhu cầu */
    }

    .row2 {
        position: absolute;
        bottom: 50px;
        /* Điều chỉnh theo nhu cầu */
        right: 20px;
        /* Điều chỉnh theo nhu cầu */
        width: 80%;
        /* Điều chỉnh chiều rộng theo nhu cầu */
        height: auto;
        /* Điều chỉnh chiều cao theo nhu cầu */
    }

    .text-end {
        text-align: right;
        /* Canh phải */
    }
</style>

<div class="content">
    <section class="content-body my-2">

        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label><strong>{{$contact->name}}</strong></label>
                    <textarea name="detail" id="editor1" placeholder="" rows="7" class="form-control" readonly>{{ $contact->content }}</textarea>
                </div>
            </div>
        </div>
        <form action="{{ route('admin.contact.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row2">
                <div class="col-md-12 text-end"> <!-- Thêm lớp text-end ở đây -->
                    <div class="mb-3">
                        <input type="text" placeholder="Nhập tiêu đề" name="title"/>
                        <label>
                            <button class="btn btn-primary"  type="submit">Trả lời</button>
                        </label> 
                        <textarea name="content" id="editor1" placeholder="Nhập câu trả lời" rows="7" class="form-control">{{ old('content') }}</textarea>
                    </div>
                </div>
        </form>
</div>

</section>
</div>