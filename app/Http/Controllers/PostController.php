<?php 
    namespace App\Http\Controllers;

use App\Http\Requests\SavePostRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Http\Request;
    class PostController  extends Controller{

        public function __construct()
        {
            $this->middleware('auth' , ['except' =>['index' , 'show']]);
        }
    
        

        public function index()
        {
            $posts = DB:: table('posts')->get();


            return  view('posts.index' , ['posts' => $posts]);
        }

        public function show(Post $post){
            
            return view('posts.show' , ['post' =>$post]);
        }

        public function create(){
            return view('posts.create' , ['post' => new Post]);

        }
        //ruta para almacenar datos del formulario
        public function store(SavePostRequest $request){
            ///con este codigo validamos los datos
            //dentro de los corchetes van las reglas de validacion

         
           // $post = new Post;
            //$post ->title = $request->input('title');
            //$post->body = $request->input('body');
            //$post->save();

            //Tenemos a eloquent, con el metodo Post, para hacer lo mismo que en las lineas anteriores
            Post::create(
               // 'title' => $request->input('title'),
                //'body' => $request->input('body'),
                $request->validated()
                );
            
            //Aqui estamos redireccionando, al blog, index
            return to_route('posts.index')->with('status' , 'Post CREADO');

        }

        //ruta para editar el post
        public function edit(Post $post){
            return view('posts.edit' , ['post' =>$post]);
        }

        public function update (SavePostRequest $request , Post $post){
        
            
          //  $post ->title = $request->input('title');
           // $post->body = $request->input('body');
            //$post->save();

            //El codigo de abajo es lo mismo que se hace arriba
            $post->update(
               // 'title' => $request ->input('title'),
                //'body' => $request ->input('body'),
                $request->validated()
            );

            
            
            //Aqui estamos redireccionando, al blog, index
            return to_route('posts.show' , $post)->with('status' , 'Post UPDATE');
        }

        public function destroy( Post $post){
          $post->delete();
          return to_route('posts.index') ->with('status' , 'Post deleted');   
        }
    }

