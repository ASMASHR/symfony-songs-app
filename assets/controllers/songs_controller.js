import { Controller } from '@hotwired/stimulus';
import axios from "axios";
export default class extends Controller {
    static values={
        infoUrl:String
    }
    play(e) {
        e.preventDefault();
        axios.get(this.infoUrlValue).then(res=>{
            console.log(res);
            const audio=new Audio(res.data.url);
            audio.play();
        })
    }
}
