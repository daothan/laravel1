<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Detail;
use App\Banner;
use App\Contact;
use App\Listening;
use App\Comment;
use Auth;
use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{

	public function index(){
		return view('welcome');
	}

    public function dashboard()
    {
        return view('admin.dashboard.index');
    }
    public function error_404(){
        return view('user_interface.layouts.user_404');
    }
    /*Show details*/
    public function user_home(){

        $newest_post = Detail::orderBy('id', 'DESC')->get();

        $listening_article = Detail::where('type','listening')->get();
        $audio          = Listening::orderBy('id','DESC')->paginate(6);
        $reading_article   = Detail::where('type','reading')->get();
        $library_article   = Detail::where('type','library')->get();

        $banner            = Banner::select('id','tittle','introduce','content')->get();

        $contact           = Contact::where('prior',1)->get();
        $max_id_contact    = Contact::max('id');
        $last_contact      = Contact::where('id',$max_id_contact)->get();

        return view('user_interface.user_home', compact('newest_post','listening_article', 'audio','reading_article', 'library_article','banner','contact','last_contact'));
        return view('user_interface.layouts.user_header', compact('banner'));
    }
    /*New post Page*/
    public function new_post(){
        $new_post = Detail::orderBy('id','DESC')->paginate(6);
        $banner            = Banner::select('id','tittle','introduce','content')->get();

        $contact           = Contact::where('prior',1)->get();
        $max_id_contact    = Contact::max('id');
        $last_contact      = Contact::where('id',$max_id_contact)->get();
        return view('user_interface.article_detail.new_post', compact('new_post','banner','contact','last_contact'));
    }
    /*Library Page*/
    public function library(){
        $library = Detail::where('type','library')->orderBy('id','DESC')->paginate(6);
        $banner            = Banner::select('id','tittle','introduce','content')->get();

        $contact           = Contact::where('prior',1)->get();
        $max_id_contact    = Contact::max('id');
        $last_contact      = Contact::where('id',$max_id_contact)->get();
        return view('user_interface.article_detail.library_page',compact('library','banner','contact','last_contact'));
    }

    /*Listening Page*/
    public function listening(){
        $listening      = Detail::where('type','listening')->orderBy('id','DESC')->paginate(6);
        $banner         = Banner::select('id','tittle','introduce','content')->get();

        $contact        = Contact::where('prior',1)->get();
        $max_id_contact = Contact::max('id');
        $last_contact   = Contact::where('id',$max_id_contact)->get();
        return view('user_interface.article_detail.listening_page',compact('listening','banner','contact','last_contact'));
    }
    /*Listening Page*/
    public function practice_listening(){
        $audio          = Listening::orderBy('id','DESC')->paginate(6);

        $banner         = Banner::select('id','tittle','introduce','content')->get();
        $contact        = Contact::where('prior',1)->get();
        $max_id_contact = Contact::max('id');
        $last_contact   = Contact::where('id',$max_id_contact)->get();
        return view('user_interface.article_detail.audio_page',compact('audio','banner','contact','last_contact'));
    }
    /*Reading Page*/
    public function reading(){
        $reading = Detail::where('type','reading')->orderBy('id','DESC')->paginate(6);
        $banner            = Banner::select('id','tittle','introduce','content')->get();

        $contact           = Contact::where('prior',1)->get();
        $max_id_contact    = Contact::max('id');
        $last_contact      = Contact::where('id',$max_id_contact)->get();
        return view('user_interface.article_detail.reading_page', compact('reading','banner','contact','last_contact'));
    }

    /*Show detail article*/
    public function detail_article(Request $request,$type,$tittle){
        $relate_article = Detail::where('type',$type)->where('alias','!=',$tittle)->orderBy('id','DESC')->get();

        $detail_article = Detail::where('alias',$tittle)->get();
        foreach($detail_article as $id_article){
            $article_id = $id_article->id;
        }
        $comment_info   = Comment::where('article_type','listening')->orWhere('article_type','reading')->orWhere('article_type','library')->where('article_id',$article_id)->orderBy('id','DESC')->paginate(10);

        $banner         = Banner::select('id','tittle','introduce','content')->get();
        $contact        = Contact::where('prior',1)->get();
        $max_id_contact = Contact::max('id');
        $last_contact   = Contact::where('id',$max_id_contact)->get();

        return view('user_interface.article_detail.article_content', compact('detail_article','relate_article','banner','contact','last_contact','comment_info'));
    }

     /*Show detail article*/
    public function tittle_audio(Request $request,$tittle_audio){
        $relate_audio = Listening::where('tittle','!=',convert_tittle($tittle_audio))->orderBy('id','DESC')->get();

        $detail_audio = Listening::where('tittle',convert_tittle($tittle_audio))->get();
        $detail_article = Detail::where('alias',$tittle_audio)->get();
        foreach($detail_article as $id_audio){
            $audio_id = $id_audio->id;
        }

        $comment_info   = Comment::where('article_type','audio')->where('article_id',$audio_id)->orderBy('id','DESC')->paginate(10);

        $banner         = Banner::select('id','tittle','introduce','content')->get();
        $contact        = Contact::where('prior',1)->get();
        $max_id_contact = Contact::max('id');
        $last_contact   = Contact::where('id',$max_id_contact)->get();

        return view('user_interface.article_detail.audio_content', compact('detail_audio','relate_audio','banner','contact','last_contact','comment_info'));
    }

    /*Contact*/
    public function contact(Request $request){
        $data = [
            'name'=>$request->input('name_contact'),
            'email'=>$request->input('email_contact'),
            'messages'=>$request->input('message_contact')
        ];
        Mail::send('user_interface.layouts.content_contact', $data,function($msg){
            $msg->from('daothan12111@gmail.com', 'Studyingenglishtoday');
            $msg->to('daothan1211@gmail.com','Quoc Than')->subject('Response from studyenglish.org');
        });
    }

}
