<label>
    Title <br>
    <input  name="title" type="text" value="{{old('title' , $post->title)}}">
      
     
    {{--Aqui estamos validando el campo title, la variable message, solo esta disponible dentro de $errors--}}
     @error('title')
        <br>
        <small style="color:red"> {{$message}} </small> 
     @enderror
 
</label><br>
   
<label>
    Body <br>
    <textarea name="body" name="" id="" cols="30" rows="10">{{old('body' , $post->body)}}</textarea>
    
    @error('body')
    <br>
    <small style="color:red"> {{$message}} </small> 
 @enderror
</label><br>