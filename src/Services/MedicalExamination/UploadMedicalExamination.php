<?php
    namespace GpiPoligran\Services\MedicalExamination;
    use GpiPoligran\Utils\ManageUploadFile;
    use GpiPoligran\Models\MedicalExamination;

    class UploadMedicalExamination {
        private ManageUploadFile $manageUploadFile;
        private int $user;

        public function __construct(
            $user
        ) {
            $this->manageUploadFile = new ManageUploadFile();
            $this->user = $user;
        }

        public function register(){
            try{
                $this->manageUploadFile::upload(
                    'image',
                    'result-examinations/' . $this->user
                );
                
                $resultExamination = new MedicalExamination();
                $resultExamination->url = 'result-examinations/' . $this->user;
                $resultExamination->user = $this->user;
                $resultExamination->save();

                return $resultExamination;
            }
            catch(\Exception $error){
                throw $error;
            }
        }
    }