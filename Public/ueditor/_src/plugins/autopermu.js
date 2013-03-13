///import core
///commands 自动排列
///commandsName  Anchor
///commandsTitle  自动排列
///commandsDialog  dialogs\anchor\anchor.html
/**
 * 自动排列
 * @function
 * @name baidu.editor.execCommands
 * @param {String} cmdName     cmdName="autopermu"自动排列
 */
    UE.commands['autopermu'] = {
        execCommand:function(){
            this.execCommand('autotypeset');
            // if(this.queryCommandValue('paragraph','h3') == 'p'){
            //     this.execCommand('paragraph','h3');
            // }else if(this.queryCommandValue('paragraph','h3') == 'h3'){
            //     this.execCommand('paragraph','p');
            // }else{}
            
        },
        queryCommandState:function(){
            console.log(this.queryCommandState('autotypeset'));
            // if(this.queryCommandValue('paragraph','h3') == 'p'){
            //     return 0;
            // }else if(this.queryCommandValue('paragraph','h3') == 'h3'){
            //     return 1;
            // }else{}
        }
    };
