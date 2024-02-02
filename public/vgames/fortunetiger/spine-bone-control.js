// @ts-check
"use strict";

class SpineBoneControl {
    constructor(debug) {
        this._bones = {}
        this._debug = debug;
    }

    get bones() {return this._bones;}
    get debug() {return this._debug;}

    setBoneControl(bone, property, value) {
        if (!this.bones.hasOwnProperty(bone))
        {
            this.bones[bone] = {};
            this.bones[bone][property] = value;        
        } else
        {
            this.bones[bone][property] = value;    
        }
    }

    removeBoneControl(bone, property) {
        if (!this.bones.hasOwnProperty(bone) || !this.bones[bone].hasOwnProperty(property)) {console.warn('[Spine] removeBoneConrtol, no control', bone, property);return}
        delete this.bones[bone][property];
    }

    removeAllBoneControl(bone, property) {
        if (!this.bones.hasOwnProperty(bone)) {console.warn('[Spine] removeAllBoneConrtol, no contro', bone);return}
        delete this.bones[bone];
    }

    applyBoneControl(skeleton) {
        const bones = this.bones;
        for(let boneName in bones)
        {
            if(!bones[boneName].hasOwnProperty('__boneControlReference'))
            {
                let boneControlReference = skeleton.findBone(boneName);
                if (!boneControlReference) {console.warn('[Spine] applyBoneControl bone not found', boneName);continue;}
                // Cache reference
                bones[boneName].__boneControlReference = boneControlReference;
            }

            for(const property in bones[boneName])
            {
                // Ignore reference to bone
                if (property == '__boneControlReference') continue;

                bones[boneName].__boneControlReference[property] = bones[boneName][property];
            }
        }
    }
    
}

// @ts-ignore
if (!globalThis.SpineBoneControl)
{
    // @ts-ignore
    globalThis.SpineBoneControl = SpineBoneControl;
}
