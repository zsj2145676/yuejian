///import core
///commands 标题
///commandsName  Anchor
///commandsTitle  标题
///commandsDialog  dialogs\anchor\anchor.html
/**
 * 标题
 * @function
 * @name baidu.editor.execCommands
 * @param {String} cmdName     cmdName="fottitle"标题
 */
    UE.commands['fortitle'] = {
        execCommand:function(){
            if(this.queryCommandValue('paragraph','h3') == 'p'){
                this.execCommand('paragraph','h3');
            }else if(this.queryCommandValue('paragraph','h3') == 'h3'){
                this.execCommand('paragraph','p');
            }else{}
            
        },
        queryCommandState:function(){
            if(this.queryCommandValue('paragraph','h3') == 'p'){
                return 0;
            }else if(this.queryCommandValue('paragraph','h3') == 'h3'){
                return 1;
            }else{}
        }
    };
