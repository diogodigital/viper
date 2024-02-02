// @ts-check
"use strict";

class SpineGLCache {
    constructor(isWebGL2, gl) {
        this._oldFrameBuffer = null;
        this._extOESVAO = null;
        this._oldVAO = null;
        this._oldProgram = null;    
        this._oldActive = null;
        this._oldTex = null;
        this._oldBinding = null;
        this._oldElement = null;
        this._oldClearColor = null;
        this._oldViewport = null;
        this._isWebGL2 = isWebGL2;
        this._gl = gl;
        this._scissor = null;
        this._scissorBox = null;
    }

    store() {
        // Save C3 webgl context

        const gl = this._gl;
        const isWebGL2 = this._isWebGL2;

        this._oldFrameBuffer = gl.getParameter(gl.FRAMEBUFFER_BINDING);

        // Save VAO (depends on gl version)
        if (!isWebGL2)
        {
            this._extOESVAO = gl.getExtension("OES_vertex_array_object");
        }

        if (isWebGL2)
        {
            this._oldVAO = gl.createVertexArray();
            this._oldVAO = gl.getParameter(gl.VERTEX_ARRAY_BINDING);
        } else
        {
            this._oldVAO = this._extOESVAO.createVertexArrayOES(); 
            this._oldVAO = gl.getParameter(this._extOESVAO.VERTEX_ARRAY_BINDING_OES);
        }

        // Save C3 wegl parameters to restore
        this._oldProgram = gl.getParameter(gl.CURRENT_PROGRAM);        
        this._oldActive = gl.getParameter(gl.ACTIVE_TEXTURE);            
        this._oldTex = gl.getParameter(gl.TEXTURE_BINDING_2D);        
        this._oldBinding = gl.getParameter(gl.ARRAY_BUFFER_BINDING);
        this._oldElement = gl.getParameter(gl.ELEMENT_ARRAY_BUFFER_BINDING);
        this._oldClearColor = gl.getParameter(gl.COLOR_CLEAR_VALUE);
        this._oldViewport = gl.getParameter(gl.VIEWPORT);
        this._scissor = gl.getParameter(gl.SCISSOR_TEST);
        if (this._scissor) this._scissorBox = gl.getParameter(gl.SCISSOR_BOX);
    }

    restore() {
        const gl = this._gl;

        // Change back to C3 FB last used
        gl.bindFramebuffer(gl.FRAMEBUFFER, this._oldFrameBuffer);

        // Restore C3 webgl state
        gl.useProgram(this._oldProgram);
        if (this._isWebGL2)
        {
            gl.bindVertexArray(this._oldVAO);
        } else
        {
            this._extOESVAO.bindVertexArrayOES(this._oldVAO); 
        }                    
        gl.activeTexture(this._oldActive);                
        gl.bindTexture(gl.TEXTURE_2D, this._oldTex);        
        gl.bindBuffer(gl.ARRAY_BUFFER, this._oldBinding);
        gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, this._oldElement);
        gl.clearColor(this._oldClearColor[0],this._oldClearColor[1],this._oldClearColor[2],this._oldClearColor[3])
        gl.enable(gl.BLEND);
        gl.blendFunc(gl.ONE, gl.ONE_MINUS_SRC_ALPHA);
        gl.viewport(this._oldViewport[0],this._oldViewport[1],this._oldViewport[2],this._oldViewport[3]);
        if (this._scissor) gl.enable(gl.SCISSOR_TEST);
        if (this._scissor) gl.scissor(this._scissorBox[0],this._scissorBox[1],this._scissorBox[2],this._scissorBox[3]);
    }

        // Save C3 webgl context, may be able to reduce some
        // Save VAO to restore
    
}

// @ts-ignore
if (!globalThis.SpineGLCache)
{
    // @ts-ignore
    globalThis.SpineGLCache = SpineGLCache;
}
